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
}

