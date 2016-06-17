<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Stock;
use AppBundle\Form\StockType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class StocksController extends FOSRestController
{
    /**
     * Retourne la liste de tous les stocks
     * @return {array} Liste des stocks
     */
    public function getStocksAction()
    {
        $stocks = $this->getDoctrine()
            ->getRepository('AppBundle:Stock')
            ->findAll();
        return $stocks;
    }

    /**
     * Retourne un stock
     * @param  Stock $stock
     * @return {Object} Stock trouvé, sinon vide (erreur 404)
     */
    public function getStockAction(Stock $stock)
    {
        return $stock;
    }

    /**
     * Supprime un stock
     * @param  Stock $stock
     */
    public function deleteStockAction(Stock $stock)
    {
        if (!$stock)
            throw $this->createNotFoundException('Aucun stock avec cet identifiant');
        $em = $this->getDoctrine()->getManager();
        $em->remove($stock);
        $em->flush();
    }

    /**
     * Ajoute un nouveau stock
     */
    public function postStocksAction(Request $request)
    {
        $stock = new Stock();
        return $this->processForm($request, $stock);
    }

    public function putStockAction(Request $request, $id)
    {
        $stock = $this->getDoctrine()
            ->getRepository('AppBundle:Stock')
            ->find($id);
        //Si rien de trouvé on retourne une erreur
        if (!$stock)
            throw $this->createNotFoundException('Aucun stock avec cet identifiant');
        return $this->processForm($request, $stock);
    }

    private function processForm(Request $request, Stock $stock)
    {
        $em = $this->getDoctrine()->getManager();

        //si nouveau retourne Created sinon No Content
        if ($em->contains($stock)) {
            $status = 204;
            $method = 'PUT';
        } else {
            $status = 201;
            $method = 'POST';
        }
        $form = $this->createForm(StockType::class, $stock, array('method' => $method));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($stock);
            $em->flush();
            $response = new JsonResponse();
            $response->setStatusCode($status);
            $response->headers->set('Location',
                $this->generateUrl(
                    'api_get_stock', array('stock' => $stock->getId())
                )
            );
            return $response;
        } else {
            return $form; //affiche les erreurs
        }
    }
}