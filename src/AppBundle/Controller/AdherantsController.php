<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Adherant;
use AppBundle\Form\AdherantType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AdherantsController extends FOSRestController
{
    /**
     * Retourne la liste de tous les adhérants
     * @return array Liste des adhérants
     */
    public function getAdherantsAction()
    {
        $adherants = $this->getDoctrine()
            ->getRepository('AppBundle:Adherant')
            ->findAll();
        return $adherants;
    }
    /**
     * Retourne un adherant
     * @param  Adherant $adherant
     * @return Adherant Adherant trouvé, sinon vide (erreur 404)
     */
    public function getAdherantAction(Adherant $adherant)
    {
        return $adherant;
    }

    /**
     * Supprime un adherant
     * @param  Adherant   $adherant
     */
    public function deleteAdherantAction(Adherant $adherant)
    {
        if (!$adherant)
            throw $this->createNotFoundException('Aucun adhérant avec cet identifiant');
        $em = $this->getDoctrine()->getManager();
        $em->remove($adherant);
        $em->flush();
    }

    /**
     * Ajoute un nouvel adherant
     */
    public function postAdherantsAction(Request $request) {
        $adherant = new Adherant();
        return $this->processForm($request, $adherant);
    }

    /**
     * Modifie un adhérant
     * @param  Request  $request
     * @param  integer  $id      Identigiant de l'adhérant à modifier
     * @return Form
     */
    public function putAdherantAction(Request $request, $id)
    {
        $adherant = $this->getDoctrine()
            ->getRepository('AppBundle:Adherant')
            ->find($id);
        //Si rien de trouvé on retourne une erreur
        if (!$adherant)
            throw $this->createNotFoundException('Aucun adherant avec cet identifiant');
        return $this->processForm($request, $adherant);
    }

    private function processForm(Request $request, Adherant $adherant) {
        $em = $this->getDoctrine()->getManager();

        //si nouveau retourne Created sinon No Content
        if ($em->contains($adherant)) {
            $status = 204;
            $method = 'PUT';
        }
        else {
            $status = 201;
            $method = 'POST';
        }
        $form = $this->createForm(AdherantType::class, $adherant, array('method' => $method));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($adherant);
            $em->flush();
            $response = new JsonResponse();
            $response->setStatusCode($status);
            $response->headers->set('Location',
                $this->generateUrl(
                    'api_get_adherant', array('adherant' => $adherant->getId())
                )
            );
            return $response;
        }
        else {
            return $form; //affiche les erreurs
        }
    }
}