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
use Lictevel\MyceliumBundle\Form\CreerChampignonType;
use Lictevel\MyceliumBundle\Form\CasejeuType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Lictevel\MyceliumBundle\Twig\AppExtension;

class MyceliumController extends Controller
{
    public function indexAction()
    {
      // On veut avoir l'URL de l'annonce d'id 5.
      return $this->render('LictevelMyceliumBundle:Mycelium:index.html.twig');


    }

    public function menuAction(Request $request)
    {
      $session = $request->getSession();

      return $this->render('LictevelMyceliumBundle:Mycelium:menu.html.twig');
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

    public function footerAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      $joueur = new Joueur();
      $joueursInscrits = $joueur->nombreJoueursInscrits($em);
      $joueursEnLigne = $joueur->nombreJoueursConnectes($em);

      return $this->render('LictevelMyceliumBundle:Mycelium:footer.html.twig', array(
        'joueursEnLigne' => $joueursEnLigne,
        'joueursInscrits' => $joueursInscrits
      ));
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

    public function creerChampignonAction(Request $request){
      $session = $request->getSession();
      $user_id = $session->get('user_id');
      if ($user_id == null || $session->has('champignon') == null){
        return $this->redirectToroute('lictevel_mycelium_home');
      }

      $em = $this->getDoctrine()->getManager();
      $champignonSession = $em->getRepository('LictevelMyceliumBundle:Champignon')
        ->findOneById($session->get('champignon')->getID())
      ;

      $champignon = new Champignon();
      $caseSporophore = new Casejeu();
      $champignon->setCaseSporophore($caseSporophore);
      $form = $this->get('form.factory')->create(CreerChampignonType::class, $champignon);

      $joueur = $em->getRepository('LictevelMyceliumBundle:Joueur')->findOneById($user_id);

      $listChampignons = $em
        ->getRepository('LictevelMyceliumBundle:Champignon')
        ->findBy(array('joueur' => $joueur))
      ;
      $coutNouveauChampi = pow(2, count($listChampignons))*10000;

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        //On regarde si le joueur a assez d'argent
        if ($champignonSession->getStockSpores() < $coutNouveauChampi){
          $request->getSession()->getFlashBag()->add('notice', "Vous n'avez pas assez de spores pour acheter un nouveau champignon.");
          return $this->redirectToRoute('lictevel_mycelium_creer_champignon');
        }

        //On change les coordonées en int si il le faut
        $caseSporophore->setAbscisse(intval($caseSporophore->getAbscisse()));
        $caseSporophore->setOrdonnee(intval($caseSporophore->getOrdonnee()));

        //On regarde si la distance au sporophore le plus proche est inférieur à 10
        $appExtension = new appExtension();
        $check = false;
        foreach ($listChampignons as $champi){
          $distance = $appExtension->palier($champi->getCaseSporophore()->getAbscisse(), $champi->getCaseSporophore()->getOrdonnee(), $caseSporophore->getAbscisse(), $caseSporophore->getOrdonnee());
          if ($distance <= 20) {
            $check = true;
            break;
          }
        }

        if ($check == false){
          $request->getSession()->getFlashBag()->add('notice', "Cette case est trop éloignée d'un autre sporophore. Choississez une nouvelle case");
          return $this->redirectToRoute('lictevel_mycelium_creer_champignon');
        }

        //On regarde si la case existe
        $caseResult = $em->getRepository('LictevelMyceliumBundle:Casejeu')->findOneBy(array(
          'abscisse' => $caseSporophore->getAbscisse(),
          'ordonnee' => $caseSporophore->getOrdonnee(),
          'joueur' => $user_id
        ));

        if ($caseResult != null){
          $request->getSession()->getFlashBag()->add('notice', "Cette case n'est pas disponible. Choisissez-en une autre.");
          return $this->redirectToRoute('lictevel_mycelium_creer_champignon');
        }

        //Si non, on créer la case
        $champignon->setStockNutriments(1300);
        $champignon->setJoueur($joueur);
        $caseSporophore->setOccupee(true);
        $caseSporophore->setJoueur($joueur);
        $caseSporophore->setChampignon($champignon);

        $champignonSession->setStockSpores($champignonSession->getStockSpores() - $coutNouveauChampi);

        $em->persist($caseSporophore);
        $em->persist($champignon);

        $em->persist($champignonSession);

        $em->flush();

        $caseSporophore->createAround($em);

        return $this->redirectToRoute('lictevel_mycelium_mes_champignons');
      }

      return $this->render('LictevelMyceliumBundle:Mycelium:creerChampignon.html.twig', array(
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
        //On vérifie que ce qu'on reçoit existe vraiment (l'utilisateur peut modifier le formulaire comme il veut)
        $case = $repository->findOneBy(array(
          'abscisse' => $casejeu->getAbscisse(),
          'ordonnee' => $casejeu->getOrdonnee(),
          'type' => $casejeu->getType(),
          'prodNutriments' => $casejeu->getProdNutriments(),
          'prodSpores' => $casejeu->getProdSpores(),
          'prodEnzymes' => $casejeu->getProdEnzymes(),
          'prodFilamentsPara' => $casejeu->getProdFilamentsPara(),
          'prodFilamentsSym' => $casejeu->getProdFilamentsSym(),
          'occupee' => false,
          'joueur' => $user_id
        ));

        if ($case == null){
          $request->getSession()->getFlashBag()->add('notice', "Cette case n'existe pas ou est déjà occupée");
          return $this->redirectToRoute('lictevel_mycelium_mon_mycelium');
        }

        //Vérifier le prix
        $champignon = $em->getRepository('LictevelMyceliumBundle:Champignon')
          ->findOneById($session->get('champignon')->getID())
        ;
        $appExtension = new AppExtension();
        $prix = $appExtension->cout($appExtension->palier($champignon->getCaseSporophore()->getAbscisse(), $champignon->getCaseSporophore()->getOrdonnee(), $case->getAbscisse(), $case->getOrdonnee()));

        if ($prix > $champignon->getStockNutriments()){
          $request->getSession()->getFlashBag()->add('notice', "Vous n'avez pas assez de nutriments pour pouvoir acheter cette case.");

          return $this->redirectToroute('lictevel_mycelium_mon_mycelium');
        }

        $champignon->setStockNutriments($champignon->getStockNutriments() - $prix);
        $champignon->setTailleMycelium($champignon->getTailleMycelium() + 1);
        $case->setChampignon($champignon);
        $case->setOccupee(true);

        $em->persist($case);
        $em->persist($champignon);

        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', "Achat réussi.");

        $case->createAround($em);

        return $this->redirectToRoute('lictevel_mycelium_mon_mycelium');
      }

      //Générer la page monMycelium
      return $this->render('LictevelMyceliumBundle:Mycelium:choisirEmplacementMycelium.html.twig', array(
        'mycelium' => $mycelium,
        'sporophore' => $session->get('champignon'),
        'form' => $form->createView(),
      ));
    }

    public function productionAction(Request $request)
    {
      $session = $request->getSession();
      $user_id = $session->get('user_id');
      if ($user_id == null){
        return $this->redirectToroute('lictevel_mycelium_home');
      }

      $em = $this->getDoctrine()->getManager();
      $champignon = $em->getRepository('LictevelMyceliumBundle:Champignon')
        ->findOneById($session->get('champignon')->getID())
      ;

      //Générer la page production
      return $this->render('LictevelMyceliumBundle:Mycelium:production.html.twig', array(
        'champignon' => $champignon,
      ));
    }

    public function mesDefensesAction()
    {
      //Générer la page mesDefenses
      return $this->render('LictevelMyceliumBundle:Mycelium:mesDefenses.html.twig');
    }

    public function statistiquesAction(Request $request)
    {
      $session = $request->getSession();
      $user_id = $session->get('user_id');
      if ($user_id == null){
        return $this->redirectToroute('lictevel_mycelium_home');
      }

      $em = $this->getDoctrine()->getManager();
      $joueur = $em->getRepository('LictevelMyceliumBundle:Joueur')->findOneById($user_id);
      $champignon = $em->getRepository('LictevelMyceliumBundle:champignon')->findOneById($session->get('champignon')->getID());
      $joueursInscrits = $joueur->nombreJoueursInscrits($em);
      $joueursEnLigne = $joueur->nombreJoueursConnectes($em);
      $nombreDeChampignons = $champignon->nombreDeChampignons($em);
      $nombreDeChampignonsPerso = $champignon->nombreDeChampignonsPerso($em);

      //Générer la page statistiques
      return $this->render('LictevelMyceliumBundle:Mycelium:statistiques.html.twig', array(
        'joueursEnLigne' => $joueursEnLigne,
        'joueursInscrits' => $joueursInscrits,
        'nombreDeChampignons' => $nombreDeChampignons,
        'nombreDeChampignonsPerso' => $nombreDeChampignonsPerso
      ));
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
