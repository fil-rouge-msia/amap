<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Benevole
 *
 * @ORM\Table(name="benevole")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BenevoleRepository")
 */
class Benevole
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
     * @ORM\Column(name="poste_benevole", type="string", length=255)
     */
    private $posteBenevole;

    /**
     * @ORM\ManyToOne(targetEntity="Amap", inversedBy="benevoles")
     */
    private $amap;

    /**
     * @ORM\OneToOne(targetEntity="Adherent")
     * @ORM\JoinColumn(name="adherent_id", referencedColumnName="id")
     */
    private $adherent;

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
     * Set posteBenevole
     *
     * @param string $posteBenevole
     *
     * @return Benevole
     */
    public function setPosteBenevole($posteBenevole)
    {
        $this->posteBenevole = $posteBenevole;

        return $this;
    }

    /**
     * Get posteBenevole
     *
     * @return string
     */
    public function getPosteBenevole()
    {
        return $this->posteBenevole;
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

    /**
     * Set adherent
     *
     * @param \AppBundle\Entity\Adherent $adherent
     *
     * @return Adherent
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
}

