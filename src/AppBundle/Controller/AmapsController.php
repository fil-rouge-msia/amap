<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Amap;
use AppBundle\Form\AmapType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AmapsController extends FOSRestController
{
    /**
     * Retourne la liste de toutes les amaps
     * @return {array} Liste des amaps
     */
    public function getAmapsAction()
    {
        $amaps = $this->getDoctrine()
                    ->getRepository('AppBundle:Amap')
                    ->findAll();

        return $amaps;
    }

    /**
     * Retourne une amap
     * @param  Amap   $amap
     * @return {Object} Amap trouvée, sinon vide (erreur 404)
     */
    public function getAmapAction(Amap $amap)
    {
        return $amap;
    }

    /**
     * Supprime une amap
     * @param  Amap   $amap
     */
    public function deleteAmapAction(Amap $amap)
    {
        if (!$amap)
            throw $this->createNotFoundException('Aucune amap avec cet identifiant');

        $em = $this->getDoctrine()->getManager();
        $em->remove($amap);
        $em->flush();
    }

    /**
     * Ajoute une nouvelle amap
     */
    public function postAmapsAction(Request $request) {
        $amap = new Amap();
        return $this->processForm($request, $amap);
    }

    public function putAmapAction(Request $request, $id)
    {
        $amap = $this->getDoctrine()
                    ->getRepository('AppBundle:Amap')
                    ->find($id);

        //Si rien de trouvé on retourne une erreur
        if (!$amap)
            throw $this->createNotFoundException('Aucun amap avec cet identifiant');

        return $this->processForm($request, $amap);
    }

    private function processForm(Request $request, Amap $amap) {
        $em = $this->getDoctrine()->getManager();
        
        //si nouveau retourne Created sinon No Content
        if ($em->contains($amap)) {
            $status = 204;
            $method = 'PUT';
        }
        else {
            $status = 201;
            $method = 'POST';
        }

        $form = $this->createForm(AmapType::class, $amap, array('method' => $method));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($amap);
            $em->flush();

            $response = new JsonResponse();
            $response->setStatusCode($status);

            $response->headers->set('Location',
                $this->generateUrl(
                    'api_get_amap', array('amap' => $amap->getId())
                )
            );

            return $response;
        }
        else {
            return $form; //affiche les erreurs
        }
    }

}
