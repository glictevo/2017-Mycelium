<?php

//src/Lictevel/MyceliumBundle/Controller/MyceliumController.php_check_syntax

namespace Lictevel\MyceliumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lictevel\MyceliumBundle\Entity\Joueur;
use Lictevel\MyceliumBundle\Entity\Image;
use Lictevel\MyceliumBundle\Entity\Champignon;
use Lictevel\MyceliumBundle\Entity\Casejeu;
use Lictevel\MyceliumBundle\Form\JoueurType;
use Lictevel\MyceliumBundle\Form\ImageType;
use Lictevel\MyceliumBundle\Form\ChampignonType;
use Lictevel\MyceliumBundle\Form\CasejeuType;
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
        $champignon = $this->getDoctrine()->getManager()
          ->getRepository('LictevelMyceliumBundle:Champignon')
          ->findOneByJoueur($joueur)
        ;
        $session->set('champignon', $champignon);

        if ($session->get('champignon') == null){
          return $this->redirectToroute('lictevel_mycelium_mon_premier_champignon');
        }

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

    public function mesChampignonsAction(Request $request)
    {
      $session = $request->getSession();
      $user_id = $session->get('user_id');
      if ($user_id == null){
        return $this->redirectToroute('lictevel_mycelium_home');
      }

      $em = $this->getDoctrine()->getManager();
      $repository = $em
        ->getRepository('LictevelMyceliumBundle:Joueur');
      ;
      $joueur = $repository->findOneById($user_id);
      $listChampignons = $em
        ->getRepository('LictevelMyceliumBundle:Champignon')
        ->findBy(array('joueur' => $joueur))
      ;

      $coutNouveauChampi = pow(2, count($listChampignons))*10000;

      $champignon = new Champignon();
      $form = $this->get('form.factory')->create(ChampignonType::class, $champignon);

      //TODO : TOUT EST A REFAIRE ICI POUR LES CASES ET TOUT
      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $champignon->setJoueur($joueur);
          $case = new Casejeu();
          $case->setOrdonnee(0);
          $case->setAbscisse(0);
          $case->setOccupee(true);
          $case->setJoueur($joueur);
          $case->setChampignon($champignon);
        $champignon->setCaseSporophore($case);

        $em->persist($case);
        $em->persist($champignon);

        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Votre champignon a bien été créé !');

        $session->set('champignon', $champignon);

        return $this->redirectToRoute('lictevel_mycelium_mes_champignons');

      }
      //Générer la page mesChampignons
      return $this->render('LictevelMyceliumBundle:Mycelium:mesChampignons.html.twig', array(
        'form' => $form->createView(),
        'cout' => $coutNouveauChampi,
        'listChampignons' => $listChampignons,
      ));
    }

    public function monPremierChampignonAction(Request $request)
    {
      $session = $request->getSession();
      $user_id = $session->get('user_id');
      if ($user_id == null){
        return $this->redirectToroute('lictevel_mycelium_home');
      }

      $em = $this->getDoctrine()->getManager();
      $repository = $em
        ->getRepository('LictevelMyceliumBundle:Joueur');
      ;
      $joueur = $repository->findOneById($user_id);

      $champignon = new Champignon();
      $form = $this->get('form.factory')->create(ChampignonType::class, $champignon);

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $champignon->setStockNutriments(1300);
        $champignon->setJoueur($joueur);
          $case = new Casejeu();
          $case->setOrdonnee(0);
          $case->setAbscisse(0);
          $case->setOccupee(true);
          $case->setJoueur($joueur);
          $case->setChampignon($champignon);
        $champignon->setCaseSporophore($case);

        $em->persist($case);
        $em->persist($champignon);

        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Votre champignon a bien été créé !');

        $session->set('champignon', $champignon);
        $case->createAround($em, $champignon);

        return $this->redirectToRoute('lictevel_mycelium_mes_champignons');

      }
      //Générer la page mesChampignons
      return $this->render('LictevelMyceliumBundle:Mycelium:monPremierChampignon.html.twig', array(
        'form' => $form->createView(),
      ));
    }

    public function mesMutationsAction()
    {
      //Générer la page mesMutations
      return $this->render('LictevelMyceliumBundle:Mycelium:mesMutations.html.twig');
    }

    public function monMyceliumAction(Request $request)
    {
      $session = $request->getSession();
      $user_id = $session->get('user_id');
      if ($user_id == null){
        return $this->redirectToroute('lictevel_mycelium_home');
      }

      $em = $this->getDoctrine()->getManager();
      $repository = $em->getRepository('LictevelMyceliumBundle:Casejeu');

      $mycelium = $repository->findMycelium($session->get('champignon'));

      //Générer la page monMycelium
      return $this->render('LictevelMyceliumBundle:Mycelium:monMycelium.html.twig', array(
        'mycelium' => $mycelium,
        'sporophore' => $session->get('champignon'),
      ));
    }

    public function choisirEmplacementMyceliumAction(Request $request)
    {
      $session = $request->getSession();
      $user_id = $session->get('user_id');
      if ($user_id == null){
        return $this->redirectToroute('lictevel_mycelium_home');
      }

      $em = $this->getDoctrine()->getManager();
      $repository = $em->getRepository('LictevelMyceliumBundle:Casejeu');

      $mycelium = $repository->findMycelium($session->get('champignon'));

      $casejeu = new Casejeu();
      $form = $this->get('form.factory')->create(CaseJeuType::class, $casejeu);

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        /*
        $request->getSession()->getFlashBag()->add('notice', 'Type :'.($casejeu->getType()));
        $request->getSession()->getFlashBag()->add('notice', 'abscisse :'.($casejeu->getAbscisse()));
        $request->getSession()->getFlashBag()->add('notice', 'ordonnee :'.($casejeu->getOrdonnee()));
        $request->getSession()->getFlashBag()->add('notice', 'prod nutriments :'.($casejeu->getProdNutriments()));
        $request->getSession()->getFlashBag()->add('notice', 'prod spores :'.($casejeu->getProdSpores()));
        $request->getSession()->getFlashBag()->add('notice', 'prod poison :'.($casejeu->getProdPoison()));
        $request->getSession()->getFlashBag()->add('notice', 'prod enzymes :'.($casejeu->getProdEnzymes()));
        $request->getSession()->getFlashBag()->add('notice', 'prod fila para :'.($casejeu->getProdFilamentsPara()));
        $request->getSession()->getFlashBag()->add('notice', 'prod file sym :'.($casejeu->getProdFilamentsSym()));
        */
        //On vérifie que ce qu'on reçoit existe vraiment (l'utilisateur peut modifier le formulaire comme il veut)
        $result = $repository->findOneBy(array(
          'abscisse' => $casejeu->getAbscisse(),
          'ordonnee' => $casejeu->getOrdonnee(),
          'type' => $casejeu->getType(),
          'prodNutriments' => $casejeu->getProdNutriments(),
          'prodSpores' => $casejeu->getProdSpores(),
          'prodEnzymes' => $casejeu->getProdEnzymes(),
          'prodFilamentsPara' => $casejeu->getProdFilamentsPara(),
          'prodFilamentsSym' => $casejeu->getProdFilamentsSym(),
          'occupee' => false
        ));

        if ($result == null){
          $request->getSession()->getFlashBag()->add('notice', "Cette case n'existe pas ou est déjà occupée");
        } else {
          $request->getSession()->getFlashBag()->add('notice', 'PASS');
        }
        //$em->persist($case);
        //$em->persist($champignon);

        //$em->flush();

        //$session->set('champignon', $champignon);
        //$case->createAround($em);

        return $this->redirectToRoute('lictevel_mycelium_mon_mycelium');
      }

      //Générer la page monMycelium
      return $this->render('LictevelMyceliumBundle:Mycelium:choisirEmplacementMycelium.html.twig', array(
        'mycelium' => $mycelium,
        'sporophore' => $session->get('champignon'),
        'form' => $form->createView(),
      ));
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
        if ($toremove != null){
          $em->remove($toremove);
        }

        $joueur->setImage($image);
        $em->persist($joueur);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', "Votre photo a été uploadée.");
      }

      $image = $joueur->getImage();
      if ($image === null){
        return $this->render('LictevelMyceliumBundle:Mycelium:monCompte.html.twig', array(
          'form' => $form->createView(),
        ));
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

    public function caracteristiquesChampignonAction(Request $request, $id){
      $session = $request->getSession();
      $user_id = $session->get('user_id');
      if ($user_id == null){
        return $this->redirectToroute('lictevel_mycelium_home');
      }

      $champignon = $this->getDoctrine()->getManager()
        ->getRepository('LictevelMyceliumBundle:Champignon')
        ->findOneById($id)
      ;

      if ($champignon == null){
        $request->getSession()->getFlashBag()->add('notice', "Ce champignon n'existe pas");
      }

      //Générer la page de caracteristique d'un champignon
      return $this->render('LictevelMyceliumBundle:Mycelium:caracteristiquesChampignon.html.twig', array(
        'champignon' => $champignon,
      ));
    }

    public function changerChampignonAction(Request $request, $id){
      $session = $request->getSession();
      $user_id = $session->get('user_id');
      if ($user_id == null){
        return $this->redirectToroute('lictevel_mycelium_home');
      }

      $champignon = $this->getDoctrine()->getManager()
        ->getRepository('LictevelMyceliumBundle:Champignon')
        ->findOneById($id)
      ;

      if ($champignon == null){
        $request->getSession()->getFlashBag()->add('notice', "Ce champignon n'existe pas");
      } else {
        if ($champignon->getJoueur()->getId() == $user_id){
          $session->set('champignon', $champignon);
        } else {
          $request->getSession()->getFlashBag()->add('notice', "Ce champignon ne vous appartient pas !");
        }
      }

      //Générer la page MEs Champignons
      return $this->redirectToroute('lictevel_mycelium_mes_champignons');
    }
}


?>
