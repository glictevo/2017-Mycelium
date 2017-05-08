Instructions pour créer la base de données :
  -S'assurer d'avoir mysql
  -Lancer les commandes suivantes depuis le repertoire projet_web :
    bin/console doctrine:database:create
    bin/console doctrine:schema:update --force

Lancer le serveur :
  -Lancer la commande suivante depuis le repertoire projet_web :
    bin/console server:start

Se rendre sur à l'url :
  localhost:8000/mycelium

Si vous voulez des stocks de nutriments ou de spores en plus (pour pouvoir tester),
lancer depuis mysql :
  -use symfony;
  -UPDATE champignon SET stock_nutriments = <valeur> WHERE id = <id de votre champignon>;
  -UPDATE champignon SET stock_spores = <valeur> WHERE id = <id de votre champignon>;

--------------------------------------------------------------------------------
LES IMPLEMENTATIONS OBLIGATOIRES
--------------------------------------------------------------------------------

Authentification :
  Lorsqu'on n'est pas connecté, possibilité de s'inscrire ou de se connecter
  dans la barre de navigation en haut à droite

Personnages :
  Lorsqu'on se connecte, on propose directement au joueur de créé son premier
  champignon.
  Le joueur pourra ensuite changer de champignon depuis la rubrique
  "Mes Champignons" lorsqu'il en aura créé d'autres.
  La création d'un personnage supplémentaire demande des ressources cependant.
  (Pour tester le site, donnez-vous des ressources grâce aux commande ci-dessus)
  Chaque personnage a ses propres ressources : nutriments, spores, poison, etc.
  Chaque personnage a ses propres actions : étendre son mycélium
  L'utilisateur peut changer de personnage à tout instant.

Ressources persistantes :
  Persistent entre les connexions successives de l'utilisateur.
  Quantité limitée (par le temps, pas de maximum cependant)
  Actions qui influent sur ces ressources : créer un nouveau champignon, étendre
  son mycélium.
  Les ressources sont affichées en bas à gauche dans le menu sur chaque page du
  site.

Points d'action :
  Toutes les ressources d'un personnage augmente avec le temps : nutriments,
  spores, etc.

Avatars :
  On peut uploader une photo depuis la page Mon Compte, disponible en cliquant
  sur son pseudo dans la barre de navigation en haut à gauche.

--------------------------------------------------------------------------------
LES IMPLEMENTATIONS EN PLUS (3 minimum étaient à faire)
--------------------------------------------------------------------------------

Affichage des personnages :
  Les personnages sont affichés lorsqu'on clique dans la barre de navigation en
  haut à droite sur Trouver un champignon, on peut depuis cette page rechercher
  un champignon avec son nom. On affiche quelques informations sur les
  champignons, avec deux boutons permettant de voir les caractéristiques de ce
  champignon, et un permettant d'envoyer un message à son propriétaire.
  De même, une page existe pour une liste des joueurs, avec recherches,
  affichage de la photo de profil, possibilité d'envoyer un message grâce à un
  bouton. Les joueurs sont affichés par ordre du plus récent qui s'est connecté.

Statistiques :
  Sur toutes les pages du site, dans le footer, s'affiche le nombre de joueurs
  inscrits et le nombre de joueur connectés (un joueur et considéré connecté si
  il a chargé une page du site il y a moins de 5 minutes)
  On a dans le menu à gauche une rubrique Statistiques affichant quelques
  statistiques concernant le joueur et le champignon (personnage) courant, ainsi
  que des statistiques sur le site.

Messages privés :
  On a la possibilité d'envoyer des messages, depuis la page
  localhost:8000/mycelium/ecrire-message, ou en cliquant sur la bouton
  permettant d'écrire un message depuis la page Mes Messages, accessible depuis
  la barre de navigation en haut à gauche. Sur cette dernière page, on trouvera
  la liste des messages envoyés et reçu, avec un bouton permettant de les lires.
  Sur la page de lecture d'un message, on pourra renvoyer un message au
  destinataire ou répondre selon les cas.
  Il existe plusieurs pages sur le site où on a accès à la page d'écriture de
  message directement avec le nom du destinataire pré-rempli.

--------------------------------------------------------------------------------
Quelques mots en plus sur le site
--------------------------------------------------------------------------------

Vous pouvez trouver les idées générales du jeu dans le fichier :
  Idée.txt

Auto-complétion :
  Nous avons une autocomplétion disponible pour la recherche de joueur et de
  champignon, ainsi que lorsqu'on rentre un destinataire lorsqu'on écrit un
  message.

Images :
  Les images du sites ont été dessinés par Timon

Les mutations et les défenses :
  Idées pour le site que nous n'avons pas eu le temps d'implémenter.
  Les mutations devait permettre, selon le type de cases où est le mycélium, de
  permettre de produire plus de ressources, et de profiter d'un bonus de
  production pendant un certain temps.
  Les défenses auraient pu servir pour le multijoueur et pour des évènements en
  général.
  Vous pouvez trouver la liste des mutations que nous voulions faire dans le
  fichier Mutation.ods

L'idée de base pour les cases :
  -- Carac de base --

  De base, une case possède les stats suivantes :

    Prod. nutriments : + [1 à 3]
    Prod. spores :	+ [1 à 2]

    Prod. poison : + [1 à 2] (Si la mutation "Poison" est achetée)
    Prod. enzymes :	+ [1 à 2] (Si la mutation "Digestion" est achetée)
    Prod. filaments para. : + [1 à 2] (Si la mutation "Parasitisme" est achetée)
    Prod. filaments sym. : + [1 à 2] (Si la mutation "Symbiose" est achetée)

  La production de base est déterminée aléatoirement, dans le domaine des valeurs
  ci dessus.

  -- Carac secondaires --

  La case peut également se voir doter d'une caractéristique secondaire parmi les
  suivantes :
  	1 - Grand organisme (possibilité de parastitisme ou symbiose)
  	2 - Petit organisme (possibilité de digestion par enzyme)
  	3 - Terrain fertile (+1 pour la prod. de ressources)
  	4 - Maladie (nécessite la mutation "Système immunitaire", la production de
  		ressources de la case est bloquée sinon)
  	5 - Terrain désert (-1 pour la production de ressources, à moins d'avoir la
  		mutation "Champicactus")
  	6 - Champignonnière abandonnée (double la production de spores sur la case)

    Une chance sur 20 pour une case d'être d'un certain type.
    6 chances sur 20 donc pour être une case spéciale.

Les cases :
  Les cases implémentent effectivement les caractéristiques secondaires.
  Cependant, comme nous n'avons pas les mutations, nous n'avons pas implémenté
  les différentes conditions nécessaires pour telle ou telle chose.
  Les ressources sont donc toutes produites sans tenir compte de l'idée de base
  pour les mutations et sans blocage (les filaments parasitiques sont produits
  malgré l'absence de mutation, par exemple).

Les prix :
  Nutriments nécessaires pour acheter une case :
    | Palier | Nutriments |
    |    1   |     100    |
    |    2   |     400    |
    |    3   |     1200   |
    |    4   |     14400  |
    |    5   |     30000  |
    |    6   |     60000  |
    |    7   |     90000  |
    |    8   |     90000  |
    |    9   |     90000  |
    |   10   |     90000  |

    Paliers :
      le prix d'une case est définie par son palier, qui correspond à
    	l'éloignement de la case par rapport à son sporophore. Les 4 cases adjacentes
    	au sporophore sont de palier 1, les cases suivantes 2, etc.. Jusqu'à une
    	limite de 10. Le joueur peut voir les cases de "palier 11" mais ne peut pas
    	les acheter, à moins de placer un champi à proximité. Si une case se trouve
    	dans la zone d'influence de deux champis, son palier est le min entre son
    	éloignement au champi 1 et son éloignement au champi 2.

  Nutriments nécessaires pour acheter une mutation : (si elles avaient été implémentées)
		| Palier | Nutriments |
		|    1   |     1200   |
		|    2   |     12000  |
		|    3   |     30000  |
		|    4   |     90000  |
		|    5   |     200000 |

    Paliers :
      les paliers des mutations sont fonction du nombre de conditions
    	(hors prix) à remplir pour débloquer une mutation. Un mutation nécessitant 2
    	conditions pour être achetée est donc de palier 2, par exemple.

  Spores nécessaires pour acheter un champignon supplémentaire :
    2ème champignon : 20 000
    3ème champignon : 40 000
    4ème champignon : 80 000
    5ème champignon : 160 000
    6ème champignon : 320 000
    etc.

Les idées derrière le parasitisme : (non implémenté)
  Lorsque le joueur achète une case sur laquelle est présente un organisme vivant
  de grande taille (on pourra donner un code couleur aux éléments), il peut
  choisir de le parasiter : la case apportera un surplus de ressource temporaire,
  puis "mourra" un bout d'un certain laps de temps.

  Il faut au champignon la même quantité de filaments parasitiques que la quantité
  de nutriments nécessaires pour acheter la case, s'il veut parasiter l'organisme
  présent. Il peut décider de le parasiter à tout moment, pas forcément dès
  l'achat de la case. En revanche, une fois le parasitage lancé, il n'y a pas de
  retour en arrière possible.

  Le parasitisme multiplie par 5 la production de ressources sur la case pendant 2
  jours. Ensuite, la case de produira plus qu'un 1 nutriment par minute, et 0
  spores.

Les idées derrière la symbiose : (non implémenté)
  Même fonctionnement que pour le parasitisme, seul l'effet diffère : lorsque le
  joueur choisit de développer une symbiose avec l'organisme de la case, il
  choisit une ressource à sacrifier. La production des autres ressources sur la
  case est doublée, indéfiniment.

Les idées derrière la digestion enzymatique : (non implémenté)
  Si un petit organisme est présent sur la case, que le champi possède la mutation
  "Digestion" et la quantité d'enzymes nécessaire ( = au prix de la case en
  nutriments), le joueur peut choisir de digérer l'organisme. Dans ce cas, au bout
  d'une journée, le champignon recevra instantanément la moitié du prix de cases
  en nutriments. L'organisme disparait ensuite de la case. Vu qu'il est mort. Du
  coup.
