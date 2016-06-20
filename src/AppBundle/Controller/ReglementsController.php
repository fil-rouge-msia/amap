<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Reglement;
use AppBundle\Form\ReglementType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ReglementsController extends FOSRestController
{
    /**
     * Retourne la liste de tous les reglements
     * @return {array} Liste des reglements
     */
    public function getReglementsAction()
    {
        $reglements = $this->getDoctrine()
            ->getRepository('AppBundle:Reglement')
            ->findAll();
        return $reglements;
    }

    /**
     * Retourne un reglement
     * @param  Reglement $reglement
     * @return {Object} Reglement trouvé, sinon vide (erreur 404)
     */
    public function getReglementAction(Reglement $reglement)
    {
        return $reglement;
    }

    /**
     * Supprime un reglement
     * @param  Reglement $reglement
     */
    public function deleteReglementAction(Reglement $reglement)
    {
        if (!$reglement)
            throw $this->createNotFoundException('Aucun reglement avec cet identifiant');
        $em = $this->getDoctrine()->getManager();
        $em->remove($reglement);
        $em->flush();
    }

    /**
     * Ajoute un nouveau reglement
     */
    public function postReglementsAction(Request $request)
    {
        $reglement = new Reglement();
        return $this->processForm($request, $reglement);
    }

    public function putReglementAction(Request $request, $id)
    {
        $reglement = $this->getDoctrine()
            ->getRepository('AppBundle:Reglement')
            ->find($id);
        //Si rien de trouvé on retourne une erreur
        if (!$reglement)
            throw $this->createNotFoundException('Aucun reglement avec cet identifiant');
        return $this->processForm($request, $reglement);
    }

    private function processForm(Request $request, Reglement $reglement)
    {
        $em = $this->getDoctrine()->getManager();

        //si nouveau retourne Created sinon No Content
        if ($em->contains($reglement)) {
            $status = 204;
            $method = 'PUT';
        } else {
            $status = 201;
            $method = 'POST';
        }
        $form = $this->createForm(ReglementType::class, $reglement, array('method' => $method));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($reglement);
            $em->flush();
            $response = new JsonResponse();
            $response->setStatusCode($status);
            $response->headers->set('Location',
                $this->generateUrl(
                    'api_get_reglement', array('reglement' => $reglement->getId())
                )
            );
            return $response;
        } else {
            return $form; //affiche les erreurs
        }
    }
}