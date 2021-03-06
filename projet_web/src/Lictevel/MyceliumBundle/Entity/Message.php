<?php

namespace Lictevel\MyceliumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lictevel\MyceliumBundle\Entity\Joueur;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="Lictevel\MyceliumBundle\Repository\MessageRepository")
 */
class Message
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
     * @ORM\Column(name="message", type="string", length=4095)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=255)
     */
    private $objet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Lictevel\MyceliumBundle\Entity\Joueur", cascade={"persist"})
     * @ORM\JoinColumn(name="expediteur", nullable=false)
     */
    private $expediteur;

    /**
     * @ORM\ManyToOne(targetEntity="Lictevel\MyceliumBundle\Entity\Joueur", cascade={"persist"})
     * @ORM\JoinColumn(name="destinataire", nullable=false)
     */
    private $destinataire;

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
     * Set message
     *
     * @param string $message
     *
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Message
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Set expediteur
     *
     * @param \Lictevel\MyceliumBundle\Entity\Joueur $expediteur
     *
     * @return Message
     */
    public function setExpediteur(\Lictevel\MyceliumBundle\Entity\Joueur $expediteur)
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    /**
     * Get expediteur
     *
     * @return \Lictevel\MyceliumBundle\Entity\Joueur
     */
    public function getExpediteur()
    {
        return $this->expediteur;
    }

    /**
     * Set objet
     *
     * @param string $objet
     *
     * @return Message
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set destinataire
     *
     * @param \Lictevel\MyceliumBundle\Entity\Joueur $destinataire
     *
     * @return Message
     */
    public function setDestinataire(\Lictevel\MyceliumBundle\Entity\Joueur $destinataire)
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    /**
     * Get destinataire
     *
     * @return \Lictevel\MyceliumBundle\Entity\Joueur
     */
    public function getDestinataire()
    {
        return $this->destinataire;
    }
}
