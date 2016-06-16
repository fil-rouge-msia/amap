<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Contrat;
use AppBundle\Form\ContratType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ContratsController extends FOSRestController
{
    /**
     * Retourne la liste de tous les contrats
     * @return {array} Liste des contrats
     */
    public function getContratsAction()
    {
        $contrats = $this->getDoctrine()
            ->getRepository('AppBundle:Contrat')
            ->findAll();
        return $contrats;
    }
    /**
     * Retourne un contrat
     * @param  Contrat   $contrat
     * @return {Object} Contrat trouvé, sinon vide (erreur 404)
     */
    public function getContratAction(Contrat $contrat)
    {
        return $contrat;
    }
    /**
     * Supprime un contrat
     * @param  Contrat   $contrat
     */
    public function deleteContratAction(Contrat $contrat)
    {
        if (!$contrat)
            throw $this->createNotFoundException('Aucun contrat avec cet identifiant');
        $em = $this->getDoctrine()->getManager();
        $em->remove($contrat);
        $em->flush();
    }
    /**
     * Ajoute un nouveau contrat
     */
    public function postContratsAction(Request $request) {
        $contrat = new Contrat();
        return $this->processForm($request, $contrat);
    }
    public function putContratAction(Request $request, $id)
    {
        $contrat = $this->getDoctrine()
            ->getRepository('AppBundle:Contrat')
            ->find($id);
        //Si rien de trouvé on retourne une erreur
        if (!$contrat)
            throw $this->createNotFoundException('Aucun contrat avec cet identifiant');
        return $this->processForm($request, $contrat);
    }
    private function processForm(Request $request, Contrat $contrat) {
        $em = $this->getDoctrine()->getManager();

        //si nouveau retourne Created sinon No Content
        if ($em->contains($contrat)) {
            $status = 204;
            $method = 'PUT';
        }
        else {
            $status = 201;
            $method = 'POST';
        }
        $form = $this->createForm(ContratType::class, $contrat, array('method' => $method));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($contrat);
            $em->flush();
            $response = new JsonResponse();
            $response->setStatusCode($status);
            $response->headers->set('Location',
                $this->generateUrl(
                    'api_get_contrat', array('contrat' => $contrat->getId())
                )
            );
            return $response;
        }
        else {
            return $form; //affiche les erreurs
        }
    }
}