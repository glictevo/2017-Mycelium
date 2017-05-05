<?php

namespace Lictevel\MyceliumBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Lictevel\MyceliumBundle\Entity\Joueur;
use Lictevel\MyceliumBundle\Entity\Champignon;
use Lictevel\MyceliumBundle\Entity\Casejeu;
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
              $prodNutriments = $champignon->getProdNutriments() * $minutes;
              $prodSpores = $champignon->getProdSpores() * $minutes;
              $prodPoison = $champignon->getProdPoison() * $minutes;
              $prodEnzymes = $champignon->getProdEnzymes() * $minutes;
              $prodFilamentsPara = $champignon->getProdFilamentsPara() * $minutes;
              $prodFilamentsSym = $champignon->getProdFilamentsSym() * $minutes;

              $stockNutriments = $champignon->getStockNutriments() + $prodNutriments;
              $stockSpores = $champignon->getStockSpores() + $prodSpores;
              $stockPoison = $champignon->getStockPoison() + $prodPoison;
              $stockEnzymes = $champignon->getStockEnzymes() + $prodEnzymes;
              $stockFilamentsPara = $champignon->getStockFilamentsPara() + $prodFilamentsPara;
              $stockFilamentsSym = $champignon->getStockFilamentsSym() + $prodFilamentsSym;

              //TODO : faire les conditions par rapport aux mutations
                //Genre que ça n'augmente pas le poison alors qu'il n'y a pas la mutation sur le champi

              $champignon->setStockNutriments($stockNutriments);
              $champignon->setStockSpores($stockSpores);
              $champignon->setStockPoison($stockPoison);
              $champignon->setStockEnzymes($stockEnzymes);
              $champignon->setStockFilamentsPara($stockFilamentsPara);
              $champignon->setStockFilamentsSym($stockFilamentsSym);

              $champignon->setTotalProdNutriments($champignon->getTotalProdNutriments() + $prodNutriments);
              $champignon->setTotalProdSpores($champignon->getTotalProdSpores() + $prodSpores);
              $champignon->setTotalProdPoison($champignon->getTotalProdPoison() + $prodPoison);
              $champignon->setTotalProdEnzymes($champignon->getTotalProdEnzymes() + $prodEnzymes);
              $champignon->setTotalProdFilamentsPara($champignon->getTotalProdFilamentsPara() + $prodFilamentsPara);
              $champignon->setTotalProdFilamentsSym($champignon->getTotalProdFilamentsSym() + $prodFilamentsSym);

              $this->em->persist($champignon);
            }
          }
          $this->em->flush();
        }
        if ($session->has('champignon') && $session->get('champignon') != null){
          $session->set('champignon', $this->em->getRepository('LictevelMyceliumBundle:Champignon')->findOneById($session->get('champignon')->getID()));
        }
      }
    }
  }
}
