<?php

namespace Lictevel\MyceliumBundle\Twig;

class AppExtension extends \Twig_extension
{
  public function getFunctions(){
    return array(
      new \Twig_SimpleFunction('palier', array($this, 'palier')),
      new \Twig_SimpleFunction('cout', array($this, 'cout')),
    );
  }

  public function palier($abscisseSporophore, $ordonneeSporophore, $abscisseCase, $ordonneeCase)
  {
    $palier = ceil(sqrt(pow($abscisseCase - $abscisseSporophore, 2) + pow($ordonneeCase - $ordonneeSporophore, 2)));

    return $palier;
  }

  public function cout($palier){
    switch($palier){
      case 1:
        return 100;
      case 2:
        return 400;
      case 3:
        return 1200;
      case 4:
        return 14400;
      case 5:
        return 30000;
      case 6:
        return 60000;
      default:
        return 90000;
    }
  }
}
