<?php

namespace Lictevel\MyceliumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\ORM\EntityManager;
use Lictevel\MyceliumBundle\Entity\Joueur;
use Lictevel\MyceliumBundle\Entity\Champignon;
use Lictevel\MyceliumBundle\Entity\Casejeu;

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
     * @ORM\ManyToOne(targetEntity="Lictevel\MyceliumBundle\Entity\Joueur", cascade={"persist"})
     * @ORM\JoinColumn(name="joueur", nullable=false)
     */
    private $joueur;

    /**
     * @var int
     *
     * @ORM\Column(name="abscisse", type="integer")
     */
    private $abscisse;

    /**
      * @var int
      *
      * @ORM\Column(name="palier", type="integer")
      */
    private $palier;

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
     * @ORM\JoinColumn(nullable=true)
     */
    private $champignon;

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

    /**
     * Set palier
     *
     * @param integer $palier
     *
     * @return Casejeu
     */
    public function setPalier($palier)
    {
        $this->palier = $palier;

        return $this;
    }

    /**
     * Get palier
     *
     * @return integer
     */
    public function getPalier()
    {
        return $this->palier;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->palier = 1;
        $this->abscisse = 0;
        $this->ordonnee = 0;
        $this->type = 'terrain normal';
        $this->prodNutriments = random_int(1,3);
        $this->prodSpores = random_int(1,2);
        $this->prodEnzymes = random_int(1,2);
        $this->prodPoison = random_int(1,2);
        $this->prodFilamentsPara = random_int(1,2);
        $this->prodFilamentsSym = random_int(1,2);
        $this->occupee = false;
        $this->bonusProdSpores = 0;
        $this->bonusProdNutriments = 0;
    }

    public function createAround(EntityManager $em){
      //On va regarder si les cases autour de cette case sont créés, si non, on les créé
      $this->check($em, 1, 1);
      $this->check($em, 1, -1);
      $this->check($em, -1, 1);
      $this->check($em, -1, -1);
    }

    public function check(EntityManager $em, $i, $j){
      $case = $em->getRepository('LictevelMyceliumBundle:Casejeu')
        ->findOneBy(array(
          'abscisse' => $this->abscisse + $i,
          'ordonnee' => $this->ordonnee + $j,
          'joueur'   => $this->joueur
      ));

      //Si on n'a pas de résultat, la case n'existe pas, on la créé
      if ($case == null){
        $newCase = new Casejeu();

        //On va choisir si la case est normale ou speciale
        $random = random_int(1,20);
        switch($random) {
          case 1:
            //Grand organisme
            $newCase->setType("grand organisme");
            break;
          case 2:
            //Petit organisme
            $newCase->setType("petit organisme");
            break;
          case 3;
            //Terrain fertile
            $newCase->setType("terrain fertile");
            $newCase->setProdNutriments($newCase->getProdNutriments() + 1);
            $newCase->setProdSpores($newCase->getProdSpores() + 1);
            $newCase->setProdPoison($newCase->getProdPoison() + 1);
            $newCase->setProdEnzymes($newCase->getProdEnzymes() + 1);
            $newCase->setProdFilamentsPara($newCase->getProdFilamentsPara() + 1);
            $newCase->setProdFilamentsSym($newCase->getProdFilamentsSym() + 1);
            break;
          case 4:
            //Maladie
            $newCase->setType("maladie");
            break;
          case 5:
            //Terrain desert
            $newCase->setType("terrain desert");
            $newCase->setProdNutriments($newCase->getProdNutriments() - 1);
            $newCase->setProdSpores($newCase->getProdSpores() - 1);
            $newCase->setProdPoison($newCase->getProdPoison() - 1);
            $newCase->setProdEnzymes($newCase->getProdEnzymes() - 1);
            $newCase->setProdFilamentsPara($newCase->getProdFilamentsPara() - 1);
            $newCase->setProdFilamentsSym($newCase->getProdFilamentsSym() - 1);
            break;
          case 6:
            //Champignonniere abandonnee
            $newCase->setType("champignonniere abandonnee");
            $newCase->setProdSpores($newCase->getProdSpores() * 2);
            break;
          default:
            //Terrain normal
            $newCase->setType("terrain normal");
            break;
        }

        $newCase->setAbscisse($this->abscisse + $i);
        $newCase->setOrdonnee($this->ordonnee + $j);
        $newCase->setPalier($this->determinerPalier($newCase->getAbscisse(), $newCase->getOrdonnee(), $em));
        $newCase->setJoueur($this->joueur);

        $em->persist($newCase);
        $em->flush();
      }
    }

    //Renvoie la palier de la case l'index indiqué
    public function determinerPalier($i, $j, EntityManager $em){
      //On réucpère tous les champignons du joueur
      $listChampignons = $em->getRepository('LictevelMyceliumBundle:Champignon')
        ->findByJoueur($this->joueur)
      ;

      $distanceMin = 9999;
      //Puis on regarde pour chacun la distance case-sporophore
      foreach ($listChampignons as $champignon){
        $caseSporophore = $champignon->getCaseSporophore();
        $abscisse = $caseSporophore->getAbscisse();
        $ordonnee = $caseSporophore->getOrdonnee();

        $distance = intval(sqrt(pow($i - $abscisse, 2) + pow($j - $ordonnee, 2)));

        if ($distance < $distanceMin){
          $distanceMin = $distance;
        }
      }

      return $distanceMin;
    }
}
