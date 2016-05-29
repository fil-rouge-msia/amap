<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Producteur;
use AppBundle\Form\ProducteurType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProducteursController extends FOSRestController
{
    /**
     * Retourne la liste de tous les producteurs
     * @return {array} Liste des producteurs
     */
    public function getProducteursAction()
    {
        $producteurs = $this->getDoctrine()
            ->getRepository('AppBundle:Producteur')
            ->findAll();
        return $producteurs;
    }
    /**
     * Retourne un producteur
     * @param  Producteur   $producteur
     * @return {Object} Producteur trouvé, sinon vide (erreur 404)
     */
    public function getProducteurAction(Producteur $producteur)
    {
        return $producteur;
    }
    /**
     * Supprime un producteur
     * @param  Producteur   $producteur
     */
    public function deleteProducteurAction(Producteur $producteur)
    {
        if (!$producteur)
            throw $this->createNotFoundException('Aucun producteur avec cet identifiant');
        $em = $this->getDoctrine()->getManager();
        $em->remove($producteur);
        $em->flush();
    }
    /**
     * Ajoute un nouveau producteur
     */
    public function postProducteursAction(Request $request) {
        $producteur = new Producteur();
        return $this->processForm($request, $producteur);
    }
    public function putProducteurAction(Request $request, $id)
    {
        $producteur = $this->getDoctrine()
            ->getRepository('AppBundle:Producteur')
            ->find($id);
        //Si rien de trouvé on retourne une erreur
        if (!$producteur)
            throw $this->createNotFoundException('Aucun producteur avec cet identifiant');
        return $this->processForm($request, $producteur);
    }
    private function processForm(Request $request, Producteur $producteur) {
        $em = $this->getDoctrine()->getManager();

        //si nouveau retourne Created sinon No Content
        if ($em->contains($producteur)) {
            $status = 204;
            $method = 'PUT';
        }
        else {
            $status = 201;
            $method = 'POST';
        }
        $form = $this->createForm(ProducteurType::class, $producteur, array('method' => $method));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($producteur);
            $em->flush();
            $response = new JsonResponse();
            $response->setStatusCode($status);
            $response->headers->set('Location',
                $this->generateUrl(
                    'api_get_producteur', array('producteur' => $producteur->getId())
                )
            );

            $response->setContent($this->container->get('serializer')->serialize($producteur, 'json'));

            return $response;
        }
        else {
            return $form; //affiche les erreurs
        }
    }
}