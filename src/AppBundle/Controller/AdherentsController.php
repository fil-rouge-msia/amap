<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Adherent;
use AppBundle\Form\AdherentType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AdherentsController extends FOSRestController
{
    /**
     * Retourne la liste de tous les adhérents
     * @QueryParam(name="benevole", default="true")
     * @return array Liste des adhérents
     */
    public function getAdherentsAction(ParamFetcher $paramFetcher)
    {
        $repo = $this->getDoctrine()
            ->getRepository('AppBundle:Adherent');

        if ($paramFetcher->get('benevole') === 'true') {
            return $repo->findAll();
        }
        else {
            return $repo->findNotBenevole();
        }
    }

    /**
     * Retourne la liste des adhérents non bénévoles
     * @return array Liste des adhérents non bénévoles
     */
    public function not_benevoleAdherentsAction() {
        $adherents = $this->getDoctrine()
            ->getRepository('AppBundle:Adherent')
            ->findNotBenevole();
        return $adherents;
    }

    /**
     * Retourne un adherent
     * @param  Adherent $adherent
     * @return Adherent Adherent trouvé, sinon vide (erreur 404)
     */
    public function getAdherentAction(Adherent $adherent)
    {
        return $adherent;
    }

    /**
     * Supprime un adherent
     * @param  Adherent   $adherent
     */
    public function deleteAdherentAction(Adherent $adherent)
    {
        if (!$adherent)
            throw $this->createNotFoundException('Aucun adhérent avec cet identifiant');
        $em = $this->getDoctrine()->getManager();
        $em->remove($adherent);
        $em->flush();
    }

    /**
     * Ajoute un nouvel adherent
     */
    public function postAdherentsAction(Request $request) {
        $adherent = new Adherent();
        return $this->processForm($request, $adherent);
    }

    /**
     * Modifie un adhérent
     * @param  Request  $request
     * @param  integer  $id      Identigiant de l'adhérent à modifier
     * @return Form
     */
    public function putAdherentAction(Request $request, $id)
    {
        $adherent = $this->getDoctrine()
            ->getRepository('AppBundle:Adherent')
            ->find($id);
        //Si rien de trouvé on retourne une erreur
        if (!$adherent)
            throw $this->createNotFoundException('Aucun adherent avec cet identifiant');
        return $this->processForm($request, $adherent);
    }

    private function processForm(Request $request, Adherent $adherent) {
        $em = $this->getDoctrine()->getManager();

        //si nouveau retourne Created sinon No Content
        if ($em->contains($adherent)) {
            $status = 204;
            $method = 'PUT';
        }
        else {
            $status = 201;
            $method = 'POST';
        }
        $form = $this->createForm(AdherentType::class, $adherent, array('method' => $method));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($adherent);
            $em->flush();
            $response = new JsonResponse();
            $response->setStatusCode($status);
            $response->headers->set('Location',
                $this->generateUrl(
                    'api_get_adherent', array('adherent' => $adherent->getId())
                )
            );
            return $response;
        }
        else {
            return $form; //affiche les erreurs
        }
    }
}