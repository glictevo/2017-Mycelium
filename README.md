(Je sais pas écrire du markdown, c'est pas la priorité là)

-Comment lancer le serveur
  -S'assurer que la base de données fonctionne
    -(lister ce qu'il faut faire pour créer ce qu'il faut dans la base de données, et que la base de données soit bien lancée avant de démarrer le serveur)
  -(Mettre les commandes, toussa)



Pour créer la base de données :
  bin/console doctrine:database:create
  bin/console doctrine:schema:update --force


Les caractéristiques de base d'un champis sont écrits dans :
  Entity/Champignon.php (dans la function construct())

Il faudra voir comment on créé les champis, toussa

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
