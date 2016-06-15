<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="saison", type="string", length=255)
     */
    private $saison;

    /**
     * @var string
     *
     * @ORM\Column(name="methode_agronomique", type="string", length=255)
     */
    private $methodeAgronomique;

    /**
     * @ORM\ManyToMany(targetEntity="Producteur", mappedBy="produits")
     */
    private $producteurs;


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
     * Set type
     *
     * @param string $type
     *
     * @return Produit
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Produit
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set saison
     *
     * @param string $saison
     *
     * @return Produit
     */
    public function setSaison($saison)
    {
        $this->saison = $saison;

        return $this;
    }

    /**
     * Get saison
     *
     * @return string
     */
    public function getSaison()
    {
        return $this->saison;
    }

    /**
     * Set methodeAgronomique
     *
     * @param string $methodeAgronomique
     *
     * @return Produit
     */
    public function setMethodeAgronomique($methodeAgronomique)
    {
        $this->methodeAgronomique = $methodeAgronomique;

        return $this;
    }

    /**
     * Get methodeAgronomique
     *
     * @return string
     */
    public function getMethodeAgronomique()
    {
        return $this->methodeAgronomique;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->producteurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add producteur
     *
     * @param \AppBundle\Entity\Producteur $producteur
     *
     * @return Produit
     */
    public function addProducteur(\AppBundle\Entity\Producteur $producteur)
    {
        $this->producteurs[] = $producteur;

        return $this;
    }

    /**
     * Remove producteur
     *
     * @param \AppBundle\Entity\Producteur $producteur
     */
    public function removeProducteur(\AppBundle\Entity\Producteur $producteur)
    {
        $this->producteurs->removeElement($producteur);
    }

    /**
     * Get producteurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducteurs()
    {
        return $this->producteurs;
    }
}
