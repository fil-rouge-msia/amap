<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stock
 *
 * @ORM\Table(name="stock")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StockRepository")
 */
class Stock
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite_produit", type="integer")
     */
    private $quantiteProduit;

    /**
     * @var bool
     *
     * @ORM\Column(name="emballage", type="boolean")
     */
    private $emballage;

    /**
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="stocks")
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity="Producteur", inversedBy="stocks")
     */
    private $producteur;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantiteProduit
     *
     * @param integer $quantiteProduit
     *
     * @return Stock
     */
    public function setQuantiteProduit($quantiteProduit)
    {
        $this->quantiteProduit = $quantiteProduit;

        return $this;
    }

    /**
     * Get quantiteProduit
     *
     * @return int
     */
    public function getQuantiteProduit()
    {
        return $this->quantiteProduit;
    }

    /**
     * Set emballage
     *
     * @param boolean $emballage
     *
     * @return Stock
     */
    public function setEmballage($emballage)
    {
        $this->emballage = $emballage;

        return $this;
    }

    /**
     * Get emballage
     *
     * @return bool
     */
    public function getEmballage()
    {
        return $this->emballage;
    }

    /**
     * Set produit
     *
     * @param \AppBundle\Entity\Produit $produit
     *
     * @return Contrat
     */
    public function setProduit(\AppBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \AppBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set producteur
     *
     * @param \AppBundle\Entity\Producteur $producteur
     *
     * @return Contrat
     */
    public function setProducteur(\AppBundle\Entity\Producteur $producteur = null)
    {
        $this->producteur = $producteur;

        return $this;
    }

    /**
     * Get producteur
     *
     * @return \AppBundle\Entity\Producteur
     */
    public function getProducteur()
    {
        return $this->producteur;
    }
}

