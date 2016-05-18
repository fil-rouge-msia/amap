<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Produit;
use AppBundle\Form\ProduitType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProduitsController extends FOSRestController
{
    /**
     * Retourne la liste de tous les produits
     * @return {array} Liste des produits
     */
    public function getProduitsAction()
    {
        $produits = $this->getDoctrine()
            ->getRepository('AppBundle:Produit')
            ->findAll();
        return $produits;
    }
    /**
     * Retourne un produit
     * @param  Produit   $produit
     * @return {Object} Amap trouvée, sinon vide (erreur 404)
     */
    public function getProduitAction(Produit $produit)
    {
        return $produit;
    }
    /**
     * Supprime un produit
     * @param  Produit   $produit
     */
    public function deleteAmapAction(Produit $produit)
    {
        if (!$produit)
            throw $this->createNotFoundException('Aucune amap avec cet identifiant');
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();
    }
    /**
     * Ajoute un nouveau produit
     */
    public function postProduitsAction(Request $request) {
        $produit = new Produit();
        return $this->processForm($request, $produit);
    }
    public function putProduitAction(Request $request, $id)
    {
        $produit = $this->getDoctrine()
            ->getRepository('AppBundle:Produit')
            ->find($id);
        //Si rien de trouvé on retourne une erreur
        if (!$produit)
            throw $this->createNotFoundException('Aucun produit avec cet identifiant');
        return $this->processForm($request, $produit);
    }
    private function processForm(Request $request, Produit $produit) {
        $em = $this->getDoctrine()->getManager();

        //si nouveau retourne Created sinon No Content
        if ($em->contains($produit)) {
            $status = 204;
            $method = 'PUT';
        }
        else {
            $status = 201;
            $method = 'POST';
        }
        $form = $this->createForm(ProduitType::class, $produit, array('method' => $method));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($produit);
            $em->flush();
            $response = new JsonResponse();
            $response->setStatusCode($status);
            $response->headers->set('Location',
                $this->generateUrl(
                    'api_get_produit', array('produit' => $produit->getId())
                )
            );
            return $response;
        }
        else {
            return $form; //affiche les erreurs
        }
    }
}