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
}

