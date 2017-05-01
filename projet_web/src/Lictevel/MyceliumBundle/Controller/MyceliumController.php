<?php

//src/Lictevel/MyceliumBundle/Controller/MyceliumController.php_check_syntax

namespace Lictevel\MyceliumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lictevel\MyceliumBundle\Entity\Joueur;
use Lictevel\MyceliumBundle\Form\JoueurType;

class MyceliumController extends Controller
{
    public function indexAction()
    {
      // On veut avoir l'URL de l'annonce d'id 5.
      return $this->render('LictevelMyceliumBundle:Mycelium:index.html.twig');


    }

    public function menuAction()
    {
      // On fixe en dur une liste ici, bien entendu par la suite
      // on la récupérera depuis la BDD !

      //J'garde ce message juste pour l'exemple
      //A supprimer ou améliorer
      $message = "";

      return $this->render('LictevelMyceliumBundle:Mycelium:menu.html.twig', array(
        'message' => $message
      ));
    }

    public function navigationAction()
    {
      return $this->render('LictevelMyceliumBundle:Mycelium:navigation.html.twig');
    }

    public function connexionAction(Request $request)
    {


      //Générer la page pour la connexion (qui propose un lien pour l'inscription)
      return $this->render('LictevelMyceliumBundle:Mycelium:connexion.html.twig');
    }

    public function inscriptionAction(Request $request)
    {
      $joueur = new Joueur();
      $form = $this->get('form.factory')->create(JoueurType::class, $joueur);

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($joueur);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Vous êtes maintenant inscrit, vous pouvez vous connecter');

        return $this->redirectToRoute('lictevel_mycelium_connexion');
      }

      //Générer la page pour l'inscription (formulaire)
      return $this->render('LictevelMyceliumBundle:Mycelium:inscription.html.twig', array(
        'form' => $form->createView(),
      ));
    }

    public function footerAction()
    {
      return $this->render('LictevelMyceliumBundle:Mycelium:footer.html.twig');
    }

    public function aProposAction()
    {
      //Générer la page A Propos
      return $this->render('LictevelMyceliumBundle:Mycelium:aPropos.html.twig');
    }

    public function mesChampignonsAction()
    {
      //Générer la page A Propos
      return $this->render('LictevelMyceliumBundle:Mycelium:mesChampignons.html.twig');
    }

    public function mesMutationsAction()
    {
      //Générer la page A Propos
      return $this->render('LictevelMyceliumBundle:Mycelium:mesMutations.html.twig');
    }

    public function monMyceliumAction()
    {
      //Générer la page A Propos
      return $this->render('LictevelMyceliumBundle:Mycelium:monMycelium.html.twig');
    }

    public function productionAction()
    {
      //Générer la page A Propos
      return $this->render('LictevelMyceliumBundle:Mycelium:production.html.twig');
    }

    public function mesDefensesAction()
    {
      //Générer la page A Propos
      return $this->render('LictevelMyceliumBundle:Mycelium:mesDefenses.html.twig');
    }

    public function statistiquesAction()
    {
      //Générer la page A Propos
      return $this->render('LictevelMyceliumBundle:Mycelium:statistiques.html.twig');
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


  public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

}


?>
