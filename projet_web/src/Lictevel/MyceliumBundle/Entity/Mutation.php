<?php

namespace Lictevel\MyceliumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mutation
 *
 * @ORM\Table(name="mutation")
 * @ORM\Entity(repositoryClass="Lictevel\MyceliumBundle\Repository\MutationRepository")
 */
class Mutation
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
     */
    private $nom;

    /**
     * @ORM\OneToOne(targetEntity="Lictevel\MyceliumBundle\Entity\Image", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="Lictevel\MyceliumBundle\Entity\Effet", cascade={"persist"})
     */
    private $effets;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Mutation
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
     * Set image
     *
     * @param \Lictevel\MyceliumBundle\Entity\Image $image
     *
     * @return Mutation
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
     * Constructor
     */
    public function __construct()
    {
        $this->effets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add effet
     *
     * @param \Lictevel\MyceliumBundle\Entity\Effet $effet
     *
     * @return Mutation
     */
    public function addEffet(\Lictevel\MyceliumBundle\Entity\Effet $effet)
    {
        $this->effets[] = $effet;

        return $this;
    }

    /**
     * Remove effet
     *
     * @param \Lictevel\MyceliumBundle\Entity\Effet $effet
     */
    public function removeEffet(\Lictevel\MyceliumBundle\Entity\Effet $effet)
    {
        $this->effets->removeElement($effet);
    }

    /**
     * Get effets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEffets()
    {
        return $this->effets;
    }
}
