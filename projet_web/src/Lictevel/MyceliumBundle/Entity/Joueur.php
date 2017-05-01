<?php

namespace Lictevel\MyceliumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Joueur
 *
 * @ORM\Table(name="joueur")
 * @ORM\Entity(repositoryClass="Lictevel\MyceliumBundle\Repository\JoueurRepository")
 */
class Joueur
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
     * @ORM\Column(name="pseudo", type="string", length=255, unique=true)
     */
    private $pseudo;

    /**
     * @ORM\OneToOne(targetEntity="Lictevel\MyceliumBundle\Entity\Image", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;

    /**
      * @var string
      *
      * @ORM\Column(name="motdepasse", type="string", length=255, unique=false)
      */
    private $motdepasse;

    /**
     * @ORM\ManyToMany(targetEntity="Lictevel\MyceliumBundle\Entity\Joueur", mappedBy="mesAmis")
     */
    private $amisAvecMoi;

    /**
     * @ORM\ManyToMany(targetEntity="Lictevel\MyceliumBundle\Entity\Joueur", inversedBy="amisAvecMoi")
     * @ORM\JoinTable(name="amis",
     *    joinColumns={@ORM\JoinColumn(name="joueur_id", referencedColumnName="id")},
     *    inverseJoinColumns={@ORM\JoinColumn(name="ami_joueur_id", referencedColumnName="id")}
     *    )
     */
    private $mesAmis;

    /**
      * @ORM\Column(name="dateInscription", type="datetime", unique=false)
      */
    private $dateInscription;


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
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return Joueur
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->amisAvecMoi = new \Doctrine\Common\Collections\ArrayCollection();
        $this->mesAmis = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set image
     *
     * @param \Lictevel\MyceliumBundle\Entity\Image $image
     *
     * @return Joueur
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
     * Add amisAvecMoi
     *
     * @param \Lictevel\MyceliumBundle\Entity\Joueur $amisAvecMoi
     *
     * @return Joueur
     */
    public function addAmisAvecMoi(\Lictevel\MyceliumBundle\Entity\Joueur $amisAvecMoi)
    {
        $this->amisAvecMoi[] = $amisAvecMoi;

        return $this;
    }

    /**
     * Remove amisAvecMoi
     *
     * @param \Lictevel\MyceliumBundle\Entity\Joueur $amisAvecMoi
     */
    public function removeAmisAvecMoi(\Lictevel\MyceliumBundle\Entity\Joueur $amisAvecMoi)
    {
        $this->amisAvecMoi->removeElement($amisAvecMoi);
    }

    /**
     * Get amisAvecMoi
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAmisAvecMoi()
    {
        return $this->amisAvecMoi;
    }

    /**
     * Add mesAmi
     *
     * @param \Lictevel\MyceliumBundle\Entity\Joueur $mesAmi
     *
     * @return Joueur
     */
    public function addMesAmi(\Lictevel\MyceliumBundle\Entity\Joueur $mesAmi)
    {
        $this->mesAmis[] = $mesAmi;

        return $this;
    }

    /**
     * Remove mesAmi
     *
     * @param \Lictevel\MyceliumBundle\Entity\Joueur $mesAmi
     */
    public function removeMesAmi(\Lictevel\MyceliumBundle\Entity\Joueur $mesAmi)
    {
        $this->mesAmis->removeElement($mesAmi);
    }

    /**
     * Get mesAmis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMesAmis()
    {
        return $this->mesAmis;
    }

    /**
     * Set motdepasse
     *
     * @param string $motdepasse
     *
     * @return Joueur
     */
    public function setMotdepasse($motdepasse)
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    /**
     * Get motdepasse
     *
     * @return string
     */
    public function getMotdepasse()
    {
        return $this->motdepasse;
    }

    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     *
     * @return Joueur
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }
}
