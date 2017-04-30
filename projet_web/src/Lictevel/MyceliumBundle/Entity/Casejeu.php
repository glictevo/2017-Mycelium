<?php

namespace Lictevel\MyceliumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Casejeu
 *
 * @ORM\Table(name="casejeu", uniqueConstraints={@UniqueConstraint(name="case_unique", columns={"abscisse", "ordonnee", "joueur"})})
 * @ORM\Entity(repositoryClass="Lictevel\MyceliumBundle\Repository\CasejeuRepository")
 */
class Casejeu
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
     * @ORM\Column(name="abscisse", type="integer")
     */
    private $abscisse;

    /**
     * @var int
     *
     * @ORM\Column(name="ordonnee", type="integer")
     */
    private $ordonnee;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="occupee", type="boolean")
     */
    private $occupee;

    /**
     * @var int
     *
     * @ORM\Column(name="prod_nutriments", type="integer")
     */
    private $prodNutriments;

    /**
     * @var int
     *
     * @ORM\Column(name="prod_spores", type="integer")
     */
    private $prodSpores;

    /**
     * @var int
     *
     * @ORM\Column(name="bonus_prod_nutriments", type="integer", nullable=true)
     */
    private $bonusProdNutriments;

    /**
     * @var int
     *
     * @ORM\Column(name="bonus_prod_spores", type="integer", nullable=true)
     */
    private $bonusProdSpores;

    /**
     * @var int
     *
     * @ORM\Column(name="prod_poison", type="integer", nullable=true)
     */
    private $prodPoison;

    /**
     * @var int
     *
     * @ORM\Column(name="prod_enzymes", type="integer", nullable=true)
     */
    private $prodEnzymes;

    /**
     * @var int
     *
     * @ORM\Column(name="prod_filaments_para", type="integer", nullable=true)
     */
    private $prodFilamentsPara;

    /**
     * @var int
     *
     * @ORM\Column(name="prod_filaments_sym", type="integer", nullable=true)
     */
    private $prodFilamentsSym;

    /**
     * @ORM\ManyToOne(targetEntity="Lictevel\MyceliumBundle\Entity\Champignon", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $champignon;

    /**
     * @ORM\ManyToOne(targetEntity="Lictevel\MyceliumBundle\Entity\Joueur", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur;


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
     * Set abscisse
     *
     * @param integer $abscisse
     *
     * @return Casejeu
     */
    public function setAbscisse($abscisse)
    {
        $this->abscisse = $abscisse;

        return $this;
    }

    /**
     * Get abscisse
     *
     * @return int
     */
    public function getAbscisse()
    {
        return $this->abscisse;
    }

    /**
     * Set ordonnee
     *
     * @param integer $ordonnee
     *
     * @return Casejeu
     */
    public function setOrdonnee($ordonnee)
    {
        $this->ordonnee = $ordonnee;

        return $this;
    }

    /**
     * Get ordonnee
     *
     * @return int
     */
    public function getOrdonnee()
    {
        return $this->ordonnee;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Casejeu
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
     * Set occupee
     *
     * @param boolean $occupee
     *
     * @return Casejeu
     */
    public function setOccupee($occupee)
    {
        $this->occupee = $occupee;

        return $this;
    }

    /**
     * Get occupee
     *
     * @return bool
     */
    public function getOccupee()
    {
        return $this->occupee;
    }

    /**
     * Set prodNutriments
     *
     * @param integer $prodNutriments
     *
     * @return Casejeu
     */
    public function setProdNutriments($prodNutriments)
    {
        $this->prodNutriments = $prodNutriments;

        return $this;
    }

    /**
     * Get prodNutriments
     *
     * @return int
     */
    public function getProdNutriments()
    {
        return $this->prodNutriments;
    }

    /**
     * Set prodSpores
     *
     * @param integer $prodSpores
     *
     * @return Casejeu
     */
    public function setProdSpores($prodSpores)
    {
        $this->prodSpores = $prodSpores;

        return $this;
    }

    /**
     * Get prodSpores
     *
     * @return int
     */
    public function getProdSpores()
    {
        return $this->prodSpores;
    }

    /**
     * Set bonusProdNutriments
     *
     * @param integer $bonusProdNutriments
     *
     * @return Casejeu
     */
    public function setBonusProdNutriments($bonusProdNutriments)
    {
        $this->bonusProdNutriments = $bonusProdNutriments;

        return $this;
    }

    /**
     * Get bonusProdNutriments
     *
     * @return int
     */
    public function getBonusProdNutriments()
    {
        return $this->bonusProdNutriments;
    }

    /**
     * Set bonusProdSpores
     *
     * @param integer $bonusProdSpores
     *
     * @return Casejeu
     */
    public function setBonusProdSpores($bonusProdSpores)
    {
        $this->bonusProdSpores = $bonusProdSpores;

        return $this;
    }

    /**
     * Get bonusProdSpores
     *
     * @return int
     */
    public function getBonusProdSpores()
    {
        return $this->bonusProdSpores;
    }

    /**
     * Set prodPoison
     *
     * @param integer $prodPoison
     *
     * @return Casejeu
     */
    public function setProdPoison($prodPoison)
    {
        $this->prodPoison = $prodPoison;

        return $this;
    }

    /**
     * Get prodPoison
     *
     * @return int
     */
    public function getProdPoison()
    {
        return $this->prodPoison;
    }

    /**
     * Set prodEnzymes
     *
     * @param integer $prodEnzymes
     *
     * @return Casejeu
     */
    public function setProdEnzymes($prodEnzymes)
    {
        $this->prodEnzymes = $prodEnzymes;

        return $this;
    }

    /**
     * Get prodEnzymes
     *
     * @return int
     */
    public function getProdEnzymes()
    {
        return $this->prodEnzymes;
    }

    /**
     * Set prodFilamentsPara
     *
     * @param integer $prodFilamentsPara
     *
     * @return Casejeu
     */
    public function setProdFilamentsPara($prodFilamentsPara)
    {
        $this->prodFilamentsPara = $prodFilamentsPara;

        return $this;
    }

    /**
     * Get prodFilamentsPara
     *
     * @return int
     */
    public function getProdFilamentsPara()
    {
        return $this->prodFilamentsPara;
    }

    /**
     * Set prodFilamentsSym
     *
     * @param integer $prodFilamentsSym
     *
     * @return Casejeu
     */
    public function setProdFilamentsSym($prodFilamentsSym)
    {
        $this->prodFilamentsSym = $prodFilamentsSym;

        return $this;
    }

    /**
     * Get prodFilamentsSym
     *
     * @return int
     */
    public function getProdFilamentsSym()
    {
        return $this->prodFilamentsSym;
    }

    /**
     * Set champignon
     *
     * @param \Lictevel\MyceliumBundle\Entity\Champignon $champignon
     *
     * @return Casejeu
     */
    public function setChampignon(\Lictevel\MyceliumBundle\Entity\Champignon $champignon)
    {
        $this->champignon = $champignon;

        return $this;
    }

    /**
     * Get champignon
     *
     * @return \Lictevel\MyceliumBundle\Entity\Champignon
     */
    public function getChampignon()
    {
        return $this->champignon;
    }

    /**
     * Set joueur
     *
     * @param \Lictevel\MyceliumBundle\Entity\Joueur $joueur
     *
     * @return Casejeu
     */
    public function setJoueur(\Lictevel\MyceliumBundle\Entity\Joueur $joueur)
    {
        $this->joueur = $joueur;

        return $this;
    }

    /**
     * Get joueur
     *
     * @return \Lictevel\MyceliumBundle\Entity\Joueur
     */
    public function getJoueur()
    {
        return $this->joueur;
    }
}
