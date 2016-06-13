<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contrat
 *
 * @ORM\Table(name="contrat")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContratRepository")
 */
class Contrat
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="saison", type="string", length=255)
     */
    private $saison;

    /**
     * @var bool
     *
     * @ORM\Column(name="part_recolte", type="boolean")
     */
    private $partRecolte;

    /**
     * @var int
     *
     * @ORM\Column(name="montant_part", type="integer")
     */
    private $montantPart;

    /**
     * @ORM\ManyToOne(targetEntity="Producteur", inversedBy="contrats")
     */
    private $producteur;

    /**
     * @ORM\ManyToOne(targetEntity="Adherent", inversedBy="contrats")
     */
    private $adherent;

    /**
     * @ORM\ManyToOne(targetEntity="Amap", inversedBy="contrats")
     */
    private $amap;


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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Contrat
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Contrat
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set saison
     *
     * @param string $saison
     *
     * @return Contrat
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
     * Set partRecolte
     *
     * @param boolean $partRecolte
     *
     * @return Contrat
     */
    public function setPartRecolte($partRecolte)
    {
        $this->partRecolte = $partRecolte;

        return $this;
    }

    /**
     * Get partRecolte
     *
     * @return bool
     */
    public function getPartRecolte()
    {
        return $this->partRecolte;
    }

    /**
     * Set montantPart
     *
     * @param integer $montantPart
     *
     * @return Contrat
     */
    public function setMontantPart($montantPart)
    {
        $this->montantPart = $montantPart;

        return $this;
    }

    /**
     * Get montantPart
     *
     * @return int
     */
    public function getMontantPart()
    {
        return $this->montantPart;
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

    /**
     * Set adherent
     *
     * @param \AppBundle\Entity\Adherent $adherent
     *
     * @return Contrat
     */
    public function setAdherent(\AppBundle\Entity\Adherent $adherent = null)
    {
        $this->adherent = $adherent;

        return $this;
    }

    /**
     * Get adherent
     *
     * @return \AppBundle\Entity\Adherent
     */
    public function getAdherent()
    {
        return $this->adherent;
    }

    /**
     * Set amap
     *
     * @param \AppBundle\Entity\Amap $amap
     *
     * @return Contrat
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
}

