<?php

//src/Lictevel/MyceliumBundle/Controller/MyceliumController.php_check_syntax

namespace Lictevel\MyceliumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lictevel\MyceliumBundle\Entity\Joueur;
use Lictevel\MyceliumBundle\Entity\Image;
use Lictevel\MyceliumBundle\Form\JoueurType;
use Lictevel\MyceliumBundle\Form\ImageType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;

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
      $session = $request->getSession();
      $user_id = $session->get('user_id');
      if ($user_id != null){
        return $this->redirectToroute('lictevel_mycelium_home');
      }


      $joueur = new Joueur();
      $form = $this->get('form.factory')->create(JoueurType::class, $joueur);
      $repository = $this->getDoctrine()->getManager()
        ->getRepository('LictevelMyceliumBundle:Joueur')
      ;

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
        $data = $form->getData();

        $joueur = $repository->findOneByPseudo($data->getPseudo());

        if ($joueur === null){
          $request->getSession()->getFlashBag()->add('notice', "Ce pseudo n'existe pas.");
          return $this->redirectToRoute('lictevel_mycelium_connexion');
        }

        if ($joueur->getMotdepasse() != $data->getMotdepasse()){
          $request->getSession()->getFlashBag()->add('notice', "Mauvais mot de passe.");
          return $this->redirectToRoute('lictevel_mycelium_connexion');
        }

        $request->getSession()->getFlashBag()->add('notice', "Vous êtes connecté !");
        $session->set('user_id', $joueur->getId());
        $session->set('pseudo', $joueur->getPseudo());

        return $this->redirectToRoute('lictevel_mycelium_connexion');
      }

      //Générer la page pour la connexion (qui propose un lien pour l'inscription)
      return $this->render('LictevelMyceliumBundle:Mycelium:connexion.html.twig', array(
        'form' => $form->createview(),
      ));
    }

    public function deconnexionAction(Request $request){
      $session = $request->getSession();
      $user_id = $session->get('user_id');
      if ($user_id == null){
        return $this->redirectToroute('lictevel_mycelium_home');
      }

      $repository = $this->getDoctrine()->getManager()
        ->getRepository('LictevelMyceliumBundle:Joueur');
      ;

      $joueur = $repository->findOneById($user_id);
      $session->clear();
      $request->getSession()->getFlashBag()->add('notice', "Vous êtes maintenant deconnecté !");

      return $this->redirectToroute('lictevel_mycelium_home');
    }

    public function inscriptionAction(Request $request)
    {
      $session = $request->getSession();
      $user_id = $session->get('user_id');
      if ($user_id != null){
        return $this->redirectToroute('lictevel_mycelium_home');
      }

      $joueur = new Joueur();
      $form = $this->get('form.factory')->create(JoueurType::class, $joueur);

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($joueur);
        try {
          $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Vous êtes maintenant inscrit, vous pouvez vous connecter');

          return $this->redirectToRoute('lictevel_mycelium_connexion');
        } catch (\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e) {
          $request->getSession()->getFlashBag()->add('notice', 'Ce pseudo est déjà utilisé.');

          return $this->redirectToRoute('lictevel_mycelium_inscription');
        }
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
      //Générer la page mesChampignons
      return $this->render('LictevelMyceliumBundle:Mycelium:mesChampignons.html.twig');
    }

    public function mesMutationsAction()
    {
      //Générer la page mesMutations
      return $this->render('LictevelMyceliumBundle:Mycelium:mesMutations.html.twig');
    }

    public function monMyceliumAction()
    {
      //Générer la page monMycelium
      return $this->render('LictevelMyceliumBundle:Mycelium:monMycelium.html.twig');
    }

    public function productionAction()
    {
      //Générer la page production
      return $this->render('LictevelMyceliumBundle:Mycelium:production.html.twig');
    }

    public function mesDefensesAction()
    {
      //Générer la page mesDefenses
      return $this->render('LictevelMyceliumBundle:Mycelium:mesDefenses.html.twig');
    }

    public function statistiquesAction()
    {
      //Générer la page statistiques
      return $this->render('LictevelMyceliumBundle:Mycelium:statistiques.html.twig');
    }

    public function monCompteAction(Request $request){
      $session = $request->getSession();
      $user_id = $session->get('user_id');
      if ($user_id == null){
        return $this->redirectToroute('lictevel_mycelium_home');
      }

      $image = new Image();
      $form = $this->get('form.factory')->create(ImageType::class, $image);
      $repository = $this->getDoctrine()->getManager()
        ->getRepository('LictevelMyceliumBundle:Joueur');
      ;
      $joueur = $repository->findOneById($user_id);

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $file = $image->getUrl();

        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move(
          $this->getParameter('images_directory'),
          $fileName
        );

        $image->setUrl($fileName);

        $em = $this->getDoctrine()->getManager();
        $image->setAlt($joueur->getPseudo().'Picture');

        //On va supprimer la photo de profil précédente si elle existe
        $toremove = $joueur->getImage();
        $em->remove($toremove);

        $joueur->setImage($image);
        $em->persist($joueur);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', "Votre photo a été uploadée.");
      }

      //Générer la page monCompte
      return $this->render('LictevelMyceliumBundle:Mycelium:monCompte.html.twig', array(
        'form' => $form->createView(),
        'url' => $joueur->getImage()->getUrl(),
        'alt' => $joueur->getImage()->getAlt(),
      ));
    }

    public function mesAmisAction(){
      //Générer la page mesAmis
      return $this->render('LictevelMyceliumBundle:Mycelium:mesAmis.html.twig');
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
