<?php

namespace Lictevel\MyceliumBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Lictevel\MyceliumBundle\Entity\Joueur;
use Lictevel\MyceliumBundle\Entity\Champignon;
use Lictevel\MyceliumBundle\EventListener;

class RessourcesUpdateListener
{
  protected $em;

  public function __construct(EntityManager $em){
    $this->em = $em;
  }

  public function processResourcesUpdate(FilterControllerEvent $event)
  {
    if (!$event->isMasterRequest()) {
     return;
    }

    $controller = $event->getController();
    $request = $event->getRequest();
    $session = $request->getSession();

    if ($session->has('user_id')){
      $repository = $this->em->getRepository('LictevelMyceliumBundle:Joueur');
      $joueur = $repository->findOneById($session->get('user_id'));

      if ($joueur != null) {
        $lastdate = $joueur->getLastUpdate();
        $listChampignons = $this->em->getRepository('LictevelMyceliumBundle:Champignon')->findByJoueur($joueur);

        $minutes = (new \Datetime())->diff($lastdate)->i;

        if ($minutes > 0){
          //$this->ressourcesUpdater.processResourcesUpdate($joueur, $this->em, $listChampignons, $minutes);


          $joueur->setLastUpdate(new \Datetime());
          $this->em->persist($joueur);

          if ($listChampignons != null) {
            foreach ($listChampignons as $champignon){
              //Faudra faire attention s'il y a des maximums
              $stockNutriments = $champignon->getStockNutriments() + ($champignon->getProdNutriments() * $minutes);
              $stockSpores = $champignon->getStockSpores() + ($champignon->getProdSpores() * $minutes);
              $stockPoison = $champignon->getStockPoison() + ($champignon->getProdPoison() * $minutes);
              $stockEnzymes = $champignon->getStockEnzymes() + ($champignon->getProdEnzymes() * $minutes);
              $stockFilamentsPara = $champignon->getStockFilamentsPara() + ($champignon->getProdFilamentsPara() * $minutes);
              $stockFilamentsSym = $champignon->getStockFilamentsSym() + ($champignon->getProdFilamentsSym() * $minutes);

              $champignon->setStockNutriments($stockNutriments);
              $champignon->setStockSpores($stockSpores);
              $champignon->setStockPoison($stockPoison);
              $champignon->setStockEnzymes($stockEnzymes);
              $champignon->setStockFilamentsPara($stockFilamentsPara);
              $champignon->setStockFilamentsSym($stockFilamentsSym);

              $this->em->persist($champignon);
            }
          }
          $this->em->flush();
        }
      }
    }
  }
}
