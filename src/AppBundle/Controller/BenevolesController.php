<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Benevole;
use AppBundle\Form\BenevoleType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BenevolesController extends FOSRestController
{
    /**
     * Retourne la liste de tous les benevoles
     * @return {array} Liste des benevoles
     */
    public function getBenevolesAction()
    {
        $benevoles = $this->getDoctrine()
            ->getRepository('AppBundle:Benevole')
            ->findAll();
        return $benevoles;
    }

    /**
     * Retourne un benevole
     * @param  Benevole $benevole
     * @return {Object} Contrat trouvé, sinon vide (erreur 404)
     */
    public function getBenevoleAction(Benevole $benevole)
    {
        return $benevole;
    }

    /**
     * Supprime un benevole
     * @param  Benevole $benevole
     */
    public function deleteBenevoleAction(Benevole $benevole)
    {
        if (!$benevole)
            throw $this->createNotFoundException('Aucun benevole avec cet identifiant');
        $em = $this->getDoctrine()->getManager();
        $em->remove($benevole);
        $em->flush();
    }

    /**
     * Ajoute un nouveau benevole
     */
    public function postBenevolesAction(Request $request)
    {
        $benevole = new Benevole();
        return $this->processForm($request, $benevole);
    }

    public function putBenevoleAction(Request $request, $id)
    {
        $benevole = $this->getDoctrine()
            ->getRepository('AppBundle:Benevole')
            ->find($id);
        //Si rien de trouvé on retourne une erreur
        if (!$benevole)
            throw $this->createNotFoundException('Aucun benevole avec cet identifiant');
        return $this->processForm($request, $benevole);
    }

    private function processForm(Request $request, Benevole $benevole)
    {
        $em = $this->getDoctrine()->getManager();

        //si nouveau retourne Created sinon No Content
        if ($em->contains($benevole)) {
            $status = 204;
            $method = 'PUT';
        } else {
            $status = 201;
            $method = 'POST';
        }
        $form = $this->createForm(BenevoleType::class, $benevole, array('method' => $method));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($benevole);
            $em->flush();
            $response = new JsonResponse();
            $response->setStatusCode($status);
            $response->headers->set('Location',
                $this->generateUrl(
                    'api_get_benevole', array('benevole' => $benevole->getId())
                )
            );
            return $response;
        } else {
            return $form; //affiche les erreurs
        }
    }
}