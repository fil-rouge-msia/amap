<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producteur
 *
 * @ORM\Table(name="producteur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProducteurRepository")
 */
class Producteur
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
     * @ORM\Column(name="nom_producteur", type="string", length=255)
     */
    private $nomProducteur;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_producteur", type="string", length=255)
     */
    private $prenomProducteur;

    /**
     * @ORM\ManyToOne(targetEntity="Amap", inversedBy="producteurs")
     */
    private $amap;

    /**
     * @var ArrayCollection $contrats
     *
     * @ORM\OneToMany(targetEntity="Contrat", mappedBy="producteur")
     */
    private $contrats;

    public function __construct()
    {
        $this->contrats = new ArrayCollection();
    }

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
     * Set nomProducteur
     *
     * @param string $nomProducteur
     *
     * @return Producteur
     */
    public function setNomProducteur($nomProducteur)
    {
        $this->nomProducteur = $nomProducteur;

        return $this;
    }

    /**
     * Get nomProducteur
     *
     * @return string
     */
    public function getNomProducteur()
    {
        return $this->nomProducteur;
    }

    /**
     * Set prenomProducteur
     *
     * @param string $prenomProducteur
     *
     * @return Producteur
     */
    public function setPrenomProducteur($prenomProducteur)
    {
        $this->prenomProducteur = $prenomProducteur;

        return $this;
    }

    /**
     * Get prenomProducteur
     *
     * @return string
     */
    public function getPrenomProducteur()
    {
        return $this->prenomProducteur;
    }

    /**
     * Set amap
     *
     * @param \AppBundle\Entity\Amap $amap
     *
     * @return Producteur
     */
    public function setAmap(\AppBundle\Entity\Amap $amap = null)
    {
        $this->amap = $amap;

        return $this;
    }

    /**
     * Get amap
     *
     * @return \AppBundle\Entity\Amap
     */
    public function getAmap()
    {
        return $this->amap;
    }

    /**
     * Add contrat
     *
     * @param \AppBundle\Entity\Contrat $contrat
     *
     * @return Producteur
     */
    public function addContrat(\AppBundle\Entity\Contrat $contrat)
    {
        $this->contrats[] = $contrat;

        return $this;
    }

    /**
     * Remove contrat
     *
     * @param \AppBundle\Entity\Contrat $contrat
     */
    public function removeContrat(\AppBundle\Entity\Contrat $contrat)
    {
        $this->contrats->removeElement($contrat);
    }

    /**
     * Get contrats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContrats()
    {
        return $this->contrats;
    }
}
