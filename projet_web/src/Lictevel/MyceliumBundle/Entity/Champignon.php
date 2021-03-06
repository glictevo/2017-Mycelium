<?php

namespace Lictevel\MyceliumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManager;
use Lictevel\MyceliumBundle\Entity\Image;

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
     * @ORM\Column(name="prod_poison", type="integer")
     */
    private $prodPoison;

    /**
     * @var int
     *
     * @ORM\Column(name="prod_enzymes", type="integer")
     */
    private $prodEnzymes;

    /**
     * @var int
     *
     * @ORM\Column(name="prod_filaments_para", type="integer")
     */
    private $prodFilamentsPara;

    /**
     * @var int
     *
     * @ORM\Column(name="prod_filaments_sym", type="integer")
     */
    private $prodFilamentsSym;

    /**
     * @var int
     *
     * @ORM\Column(name="taille_mycelium", type="integer")
     */
    private $tailleMycelium;

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
     * @ORM\Column(name="stock_poison", type="integer")
     */
    private $stockPoison;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_enzymes", type="integer")
     */
    private $stockEnzymes;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_filaments_para", type="integer")
     */
    private $stockFilamentsPara;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_filaments_sym", type="integer")
     */
    private $stockFilamentsSym;

    /**
     * @ORM\ManyToOne(targetEntity="Lictevel\MyceliumBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur;

    /**
     * @ORM\OneToOne(targetEntity="Lictevel\MyceliumBundle\Entity\Casejeu", cascade={"persist"})
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
     * @var int
     *
     * @ORM\Column(name="total_prod_nutriments", type="integer")
     */
    private $TotalProdNutriments;

    /**
     * @var int
     *
     * @ORM\Column(name="total_prod_spores", type="integer")
     */
    private $TotalProdSpores;

    /**
     * @var int
     *
     * @ORM\Column(name="total_prod_poison", type="integer")
     */
    private $TotalProdPoison;

    /**
     * @var int
     *
     * @ORM\Column(name="total_prod_enzymes", type="integer")
     */
    private $TotalProdEnzymes;

    /**
     * @var int
     *
     * @ORM\Column(name="total_prod_filaments_para", type="integer")
     */
    private $TotalProdFilamentsPara;

    /**
     * @var int
     *
     * @ORM\Column(name="total_prod_filaments_sym", type="integer")
     */
    private $TotalProdFilamentsSym;


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

        $this->prodNutriments = 20;
        $this->prodSpores = 2;
        $this->prodPoison = 0;
        $this->prodEnzymes = 0;
        $this->prodFilamentsSym = 0;
        $this->prodFilamentsPara = 0;

        $this->tailleMycelium = 1;

        $this->stockNutriments = 100;
        $this->stockSpores = 0;
        $this->stockPoison = 0;
        $this->stockEnzymes = 0;
        $this->stockFilamentsSym = 0;
        $this->stockFilamentsPara = 0;

        $this->TotalProdNutriments = 0;
        $this->TotalProdSpores = 0;
        $this->TotalProdPoison = 0;
        $this->TotalProdEnzymes = 0;
        $this->TotalProdFilamentsPara = 0;
        $this->TotalProdFilamentsSym = 0;

        $image = new Image();
        $random = random_int(1,8);
        $image->setUrl("images/champignons/champ".$random.".png");
        $image->setAlt("image champignon ".$random);
        $this->setImage($image);
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Champignon
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set totalProdNutriments
     *
     * @param integer $totalProdNutriments
     *
     * @return Champignon
     */
    public function setTotalProdNutriments($totalProdNutriments)
    {
        $this->TotalProdNutriments = $totalProdNutriments;

        return $this;
    }

    /**
     * Get totalProdNutriments
     *
     * @return integer
     */
    public function getTotalProdNutriments()
    {
        return $this->TotalProdNutriments;
    }

    /**
     * Set totalProdSpores
     *
     * @param integer $totalProdSpores
     *
     * @return Champignon
     */
    public function setTotalProdSpores($totalProdSpores)
    {
        $this->TotalProdSpores = $totalProdSpores;

        return $this;
    }

    /**
     * Get totalProdSpores
     *
     * @return integer
     */
    public function getTotalProdSpores()
    {
        return $this->TotalProdSpores;
    }

    /**
     * Set totalProdPoison
     *
     * @param integer $totalProdPoison
     *
     * @return Champignon
     */
    public function setTotalProdPoison($totalProdPoison)
    {
        $this->TotalProdPoison = $totalProdPoison;

        return $this;
    }

    /**
     * Get totalProdPoison
     *
     * @return integer
     */
    public function getTotalProdPoison()
    {
        return $this->TotalProdPoison;
    }

    /**
     * Set totalProdEnzymes
     *
     * @param integer $totalProdEnzymes
     *
     * @return Champignon
     */
    public function setTotalProdEnzymes($totalProdEnzymes)
    {
        $this->TotalProdEnzymes = $totalProdEnzymes;

        return $this;
    }

    /**
     * Get totalProdEnzymes
     *
     * @return integer
     */
    public function getTotalProdEnzymes()
    {
        return $this->TotalProdEnzymes;
    }

    /**
     * Set totalProdFilamentsPara
     *
     * @param integer $totalProdFilamentsPara
     *
     * @return Champignon
     */
    public function setTotalProdFilamentsPara($totalProdFilamentsPara)
    {
        $this->TotalProdFilamentsPara = $totalProdFilamentsPara;

        return $this;
    }

    /**
     * Get totalProdFilamentsPara
     *
     * @return integer
     */
    public function getTotalProdFilamentsPara()
    {
        return $this->TotalProdFilamentsPara;
    }

    /**
     * Set totalProdFilamentsSym
     *
     * @param integer $totalProdFilamentsSym
     *
     * @return Champignon
     */
    public function setTotalProdFilamentsSym($totalProdFilamentsSym)
    {
        $this->TotalProdFilamentsSym = $totalProdFilamentsSym;

        return $this;
    }

    /**
     * Get totalProdFilamentsSym
     *
     * @return integer
     */
    public function getTotalProdFilamentsSym()
    {
        return $this->TotalProdFilamentsSym;
    }

    public function ajouterCase($case){
      $this->prodNutriments += $case->getProdNutriments();
      $this->prodSpores += $case->getProdSpores();
      $this->prodPoison += $case->getProdPoison();
      $this->prodEnzymes += $case->getProdEnzymes();
      $this->prodFilamentsPara += $case->getProdFilamentsPara();
      $this->prodFilamentsSym += $case->getProdFilamentsSym();
    }

    public function nombreDeChampignons(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findAll();
      return count($result);
    }

    public function nombreDeChampignonsPerso(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findByJoueur($this->getJoueur());
      return count($result);
    }

    public function productionTotaleNutriments(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findAll();
      $prod = 0;

      foreach ($result as $champignon){
        $prod += $champignon->getTotalProdNutriments();
      }

      return $prod;
    }

    public function productionTotaleNutrimentsPerso(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findByJoueur($this->getJoueur());
      $prod = 0;

      foreach ($result as $champignon){
        $prod += $champignon->getTotalProdNutriments();
      }

      return $prod;
    }

    public function productionTotaleSpores(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findAll();
      $prod = 0;

      foreach ($result as $champignon){
        $prod += $champignon->getTotalProdSpores();
      }

      return $prod;
    }

    public function productionTotaleSporesPerso(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findByJoueur($this->getJoueur());
      $prod = 0;

      foreach ($result as $champignon){
        $prod += $champignon->getTotalProdSpores();
      }

      return $prod;
    }

    public function productionTotalePoison(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findAll();
      $prod = 0;

      foreach ($result as $champignon){
        $prod += $champignon->getTotalProdPoison();
      }

      return $prod;
    }

    public function productionTotalePoisonPerso(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findByJoueur($this->getJoueur());
      $prod = 0;

      foreach ($result as $champignon){
        $prod += $champignon->getTotalProdPoison();
      }

      return $prod;
    }

    public function productionTotaleEnzymes(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findAll();
      $prod = 0;

      foreach ($result as $champignon){
        $prod += $champignon->getTotalProdEnzymes();
      }

      return $prod;
    }

    public function productionTotaleEnzymesPerso(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findByJoueur($this->getJoueur());
      $prod = 0;

      foreach ($result as $champignon){
        $prod += $champignon->getTotalProdEnzymes();
      }

      return $prod;
    }

    public function productionTotaleFilamentsPara(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findAll();
      $prod = 0;

      foreach ($result as $champignon){
        $prod += $champignon->getTotalProdFilamentsPara();
      }

      return $prod;
    }

    public function productionTotaleFilamentsParaPerso(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findByJoueur($this->getJoueur());
      $prod = 0;

      foreach ($result as $champignon){
        $prod += $champignon->getTotalProdFilamentsPara();
      }

      return $prod;
    }

    public function productionTotaleFilamentsSym(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findAll();
      $prod = 0;

      foreach ($result as $champignon){
        $prod += $champignon->getTotalProdFilamentsSym();
      }

      return $prod;
    }

    public function productionTotaleFilamentsSymPerso(EntityManager $em){
      $repository = $em->getRepository('LictevelMyceliumBundle:Champignon');
      $result = $repository->findByJoueur($this->getJoueur());
      $prod = 0;

      foreach ($result as $champignon){
        $prod += $champignon->getTotalProdFilamentsSym();
      }

      return $prod;
    }
}
