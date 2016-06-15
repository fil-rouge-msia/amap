<?php
namespace AppBundle\Controller;

use AppBundle\Entity\MethodeReglement;
use AppBundle\Form\MethodeReglementType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MethodesReglementsController extends FOSRestController
{
    /**
     * Retourne la liste de toutes les méthodes réglements
     * @return {array} Liste des méthodes réglements
     */
    public function getMethodesReglementsAction()
    {
        $methodesReglements = $this->getDoctrine()
            ->getRepository('AppBundle:MethodeReglement')
            ->findAll();
        return $methodesReglements;
    }

    /**
     * Retourne une methode reglement
     * @param  MethodeReglement $methodeReglement
     * @return {Object} Contrat trouvé, sinon vide (erreur 404)
     */
    public function getMethodeReglementAction(MethodeReglement $methodeReglement)
    {
        return $methodeReglement;
    }

    /**
     * Supprime une methode reglement
     * @param  MethodeReglement $methodeReglement
     */
    public function deleteMethodeReglementAction(MethodeReglement $methodeReglement)
    {
        if (!$methodeReglement)
            throw $this->createNotFoundException('Aucune methode reglement avec cet identifiant');
        $em = $this->getDoctrine()->getManager();
        $em->remove($methodeReglement);
        $em->flush();
    }

    /**
     * Ajoute une nouvelle methode reglement
     */
    public function postContratsAction(Request $request)
    {
        $methodeReglement = new MethodeReglement();
        return $this->processForm($request, $methodeReglement);
    }

    public function putMethodeReglementAction(Request $request, $id)
    {
        $methodeReglement = $this->getDoctrine()
            ->getRepository('AppBundle:MethodeReglement')
            ->find($id);
        //Si rien de trouvé on retourne une erreur
        if (!$methodeReglement)
            throw $this->createNotFoundException('Aucune methode de reglement avec cet identifiant');
        return $this->processForm($request, $methodeReglement);
    }

    private function processForm(Request $request, MethodeReglement $methodeReglement)
    {
        $em = $this->getDoctrine()->getManager();

        //si nouveau retourne Created sinon No Content
        if ($em->contains($methodeReglement)) {
            $status = 204;
            $method = 'PUT';
        } else {
            $status = 201;
            $method = 'POST';
        }
        $form = $this->createForm(MethodeReglementType::class, $methodeReglement, array('method' => $method));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($methodeReglement);
            $em->flush();
            $response = new JsonResponse();
            $response->setStatusCode($status);
            $response->headers->set('Location',
                $this->generateUrl(
                    'api_get_methodereglement', array('methodeReglement' => $methodeReglement->getId())
                )
            );
            return $response;
        } else {
            return $form; //affiche les erreurs
        }
    }
}