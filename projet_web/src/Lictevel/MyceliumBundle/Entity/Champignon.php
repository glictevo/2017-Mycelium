<?php

namespace Lictevel\MyceliumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Champignon
 *
 * @ORM\Table(name="champignon")
 * @ORM\Entity(repositoryClass="Lictevel\MyceliumBundle\Repository\ChampignonRepository")
 */
class Champignon
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
      * @ORM\Column(name="pseudo", type="string", length=255, unique=false)
      */
    private $name;

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
     * @var int
     *
     * @ORM\Column(name="nb_PA_max", type="integer")
     */
    private $nbPAMax;

    /**
     * @var int
     *
     * @ORM\Column(name="prod_PA", type="integer")
     */
    private $prodPA;

    /**
     * @var int
     *
     * @ORM\Column(name="taille_mycelium", type="integer")
     */
    private $tailleMycelium;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_PA", type="integer")
     */
    private $stockPA;

    /**
     * @var int
     *
     * @ORM\Column(name="Stock_nutriments", type="integer")
     */
    private $stockNutriments;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_spores", type="integer")
     */
    private $stockSpores;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_poison", type="integer", nullable=true)
     */
    private $stockPoison;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_enzymes", type="integer", nullable=true)
     */
    private $stockEnzymes;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_filaments_para", type="integer", nullable=true)
     */
    private $stockFilamentsPara;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_filaments_sym", type="integer", nullable=true)
     */
    private $stockFilamentsSym;

    /**
     * @ORM\ManyToOne(targetEntity="Lictevel\MyceliumBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur;

    /**
     * @ORM\OneToOne(targetEntity="Lictevel\MyceliumBundle\Entity\Casejeu")
     * @ORM\JoinColumn(nullable=false)
     */
    private $caseSporophore;

    /**
     * @ORM\OneToOne(targetEntity="Lictevel\MyceliumBundle\Entity\Image", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="Lictevel\MyceliumBundle\Entity\Mutation", cascade={"persist"})
     */
    private $mutations;

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
     * Set prodNutriments
     *
     * @param integer $prodNutriments
     *
     * @return Champignon
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
     * @return Champignon
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
     * Set prodPoison
     *
     * @param integer $prodPoison
     *
     * @return Champignon
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
     * @return Champignon
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
     * @return Champignon
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
     * @return Champignon
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
     * Set nbPAMax
     *
     * @param integer $nbPAMax
     *
     * @return Champignon
     */
    public function setNbPAMax($nbPAMax)
    {
        $this->nbPAMax = $nbPAMax;

        return $this;
    }

    /**
     * Get nbPAMax
     *
     * @return int
     */
    public function getNbPAMax()
    {
        return $this->nbPAMax;
    }

    /**
     * Set prodPA
     *
     * @param integer $prodPA
     *
     * @return Champignon
     */
    public function setProdPA($prodPA)
    {
        $this->prodPA = $prodPA;

        return $this;
    }

    /**
     * Get prodPA
     *
     * @return int
     */
    public function getProdPA()
    {
        return $this->prodPA;
    }

    /**
     * Set tailleMycelium
     *
     * @param integer $tailleMycelium
     *
     * @return Champignon
     */
    public function setTailleMycelium($tailleMycelium)
    {
        $this->tailleMycelium = $tailleMycelium;

        return $this;
    }

    /**
     * Get tailleMycelium
     *
     * @return int
     */
    public function getTailleMycelium()
    {
        return $this->tailleMycelium;
    }

    /**
     * Set stockPA
     *
     * @param integer $stockPA
     *
     * @return Champignon
     */
    public function setStockPA($stockPA)
    {
        $this->stockPA = $stockPA;

        return $this;
    }

    /**
     * Get stockPA
     *
     * @return int
     */
    public function getStockPA()
    {
        return $this->stockPA;
    }

    /**
     * Set stockNutriments
     *
     * @param integer $stockNutriments
     *
     * @return Champignon
     */
    public function setStockNutriments($stockNutriments)
    {
        $this->stockNutriments = $stockNutriments;

        return $this;
    }

    /**
     * Get stockNutriments
     *
     * @return int
     */
    public function getStockNutriments()
    {
        return $this->stockNutriments;
    }

    /**
     * Set stockSpores
     *
     * @param integer $stockSpores
     *
     * @return Champignon
     */
    public function setStockSpores($stockSpores)
    {
        $this->stockSpores = $stockSpores;

        return $this;
    }

    /**
     * Get stockSpores
     *
     * @return int
     */
    public function getStockSpores()
    {
        return $this->stockSpores;
    }

    /**
     * Set stockPoison
     *
     * @param integer $stockPoison
     *
     * @return Champignon
     */
    public function setStockPoison($stockPoison)
    {
        $this->stockPoison = $stockPoison;

        return $this;
    }

    /**
     * Get stockPoison
     *
     * @return int
     */
    public function getStockPoison()
    {
        return $this->stockPoison;
    }

    /**
     * Set stockEnzymes
     *
     * @param integer $stockEnzymes
     *
     * @return Champignon
     */
    public function setStockEnzymes($stockEnzymes)
    {
        $this->stockEnzymes = $stockEnzymes;

        return $this;
    }

    /**
     * Get stockEnzymes
     *
     * @return int
     */
    public function getStockEnzymes()
    {
        return $this->stockEnzymes;
    }

    /**
     * Set stockFilamentsPara
     *
     * @param integer $stockFilamentsPara
     *
     * @return Champignon
     */
    public function setStockFilamentsPara($stockFilamentsPara)
    {
        $this->stockFilamentsPara = $stockFilamentsPara;

        return $this;
    }

    /**
     * Get stockFilamentsPara
     *
     * @return int
     */
    public function getStockFilamentsPara()
    {
        return $this->stockFilamentsPara;
    }

    /**
     * Set stockFilamentsSym
     *
     * @param integer $stockFilamentsSym
     *
     * @return Champignon
     */
    public function setStockFilamentsSym($stockFilamentsSym)
    {
        $this->stockFilamentsSym = $stockFilamentsSym;

        return $this;
    }

    /**
     * Get stockFilamentsSym
     *
     * @return int
     */
    public function getStockFilamentsSym()
    {
        return $this->stockFilamentsSym;
    }

    /**
     * Set joueur
     *
     * @param \Lictevel\MyceliumBundle\Entity\Joueur $joueur
     *
     * @return Champignon
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mutations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set caseSporophore
     *
     * @param \Lictevel\MyceliumBundle\Entity\Casejeu $caseSporophore
     *
     * @return Champignon
     */
    public function setCaseSporophore(\Lictevel\MyceliumBundle\Entity\Casejeu $caseSporophore)
    {
        $this->caseSporophore = $caseSporophore;

        return $this;
    }

    /**
     * Get caseSporophore
     *
     * @return \Lictevel\MyceliumBundle\Entity\Casejeu
     */
    public function getCaseSporophore()
    {
        return $this->caseSporophore;
    }

    /**
     * Set image
     *
     * @param \Lictevel\MyceliumBundle\Entity\Image $image
     *
     * @return Champignon
     */
    public function setImage(\Lictevel\MyceliumBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Lictevel\MyceliumBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add mutation
     *
     * @param \Lictevel\MyceliumBundle\Entity\Mutation $mutation
     *
     * @return Champignon
     */
    public function addMutation(\Lictevel\MyceliumBundle\Entity\Mutation $mutation)
    {
        $this->mutations[] = $mutation;

        return $this;
    }

    /**
     * Remove mutation
     *
     * @param \Lictevel\MyceliumBundle\Entity\Mutation $mutation
     */
    public function removeMutation(\Lictevel\MyceliumBundle\Entity\Mutation $mutation)
    {
        $this->mutations->removeElement($mutation);
    }

    /**
     * Get mutations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMutations()
    {
        return $this->mutations;
    }
}
