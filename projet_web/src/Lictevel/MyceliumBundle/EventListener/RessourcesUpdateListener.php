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
              $stockNutriments = $champignon->getStockNutriments() + ($champignon->getProdNutriments() * $minutes);
              $stockSpores = $champignon->getStockSpores() + ($champignon->getProdSpores() * $minutes);
              $stockPoison = $champignon->getStockPoison() + ($champignon->getProdPoison() * $minutes);
              $stockEnzymes = $champignon->getStockEnzymes() + ($champignon->getProdEnzymes() * $minutes);
              $stockFilamentsPara = $champignon->getStockFilamentsPara() + ($champignon->getProdFilamentsPara() * $minutes);
              $stockFilamentsSym = $champignon->getStockFilamentsSym() + ($champignon->getProdFilamentsSym() * $minutes);

              //On charge la liste des cases reliées au champignon
              //TODO : faire les conditions par rapport aux mutations
                //Genre que ça n'augmente pas le poison alors qu'il n'y a pas la mutation sur le champi
              $cases = $this->em->getRepository('LictevelMyceliumBundle:Casejeu')->findByChampignon($champignon);
              if ($cases != null){
                foreach ($cases as $case){
                  $stockNutriments += $case->getProdNutriments();
                  $stockSpores += $case->getProdSpores();
                  $stockPoison += $case->getProdPoison();
                  $stockEnzymes += $case->getProdEnzymes();
                  $stockFilamentsPara += $case->getProdFilamentsPara();
                  $stockFilamentsSym += $case->getProdFilamentsSym();
                }
              }

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
          $session->set('champignon', $this->em->getRepository('LictevelMyceliumBundle:Champignon')->findOneById($session->get('champignon')->getID()));
        }
      }
    }
  }
}
