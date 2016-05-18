<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Amap
 *
 * @ORM\Table(name="amap")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AmapRepository")
 */
class Amap
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
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="bancaire", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $bancaire;

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
     * Set id
     *
     * @param int $id
     *
     * @return Amap
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Amap
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Amap
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Amap
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set bancaire
     *
     * @param string $bancaire
     *
     * @return Amap
     */
    public function setBancaire($bancaire)
    {
        $this->bancaire = $bancaire;

        return $this;
    }

    /**
     * Get bancaire
     *
     * @return string
     */
    public function getBancaire()
    {
        return $this->bancaire;
    }
}
