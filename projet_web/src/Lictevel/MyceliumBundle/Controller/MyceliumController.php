<?php

//src/Lictevel/MyceliumBundle/Controller/MyceliumController.php_check_syntax

namespace Lictevel\MyceliumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MyceliumController extends Controller
{
    public function indexAction()
    {
      // On veut avoir l'URL de l'annonce d'id 5.
      $url = $this->get('router')->generate(
          'lictevel_mycelium_view', // 1er argument : le nom de la route
          array('id' => 5)    // 2e argument : les valeurs des paramètres
      );
      // $url vaut « /platform/advert/5 »

      return new Response("L'URL de l'annonce d'id 5 est : ".$url);
    }

    public function viewAction($id, Request $request)
    {
      $tag = $request
        ->query
        ->get('tag')
      ;

      return $this->render('LictevelMyceliumBundle:Mycelium:view.html.twig', array(
        'id'  => $id,
        'tag' => $tag,
      ));
    }

    public function viewSlugAction($slug, $year, $format)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au
            slug '".$slug."', créée en ".$year." et au format ".$format."."
        );
    }

}


?>
