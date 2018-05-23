# PHP Checkpoint 3

Une fois de plus, le capitaine Jack Sparrow à repris le large mais a perdu son magnifique compas ! Vous devrez l'aider à retrouver ce trésor. 
Jack, ou plutôt son bateau, peut se déplacer sur une carte composé de 9 tuiles. Chaque tuile est identifié par des coordonées (x, y) et par un type (mer, port, ile). 
Vous pouvez récupérer le bateau de Jack dans les controllers grace à la méthode *$this->getBoat()*.

- Clonez le dépot [URL], veillez au *composer install* et au *parameters.php*.

- Créez une base de données *checkpoint_3* et importez-y le fichier *db.sql*.

- Lisez tous le sujet avant de commencer à coder ;)

- Vous devez créer un service *MapManager* dans le dossier de votre choix (soyez cohérent), et y coder une fonction caseExists($x, $y) : bool. Hint : Pensez à utiliser TileRepository dans votre service.

- Dans BoatController, créez une méthode moveDirection() prenant en paramètre une direction qui peut être *n*, *s*, *e* ou *w*. Par exemple, */boat/move/w*. Une direction non autorisé dans l'url, par exemple *a*, devra générer une erreur 404. 
La méthode devra bouger le bateau dans la bonne direction. Vous devez utiliser la méthode caseExists de votre service pour éventuellement afficher un message d'erreur si le déplacement est impossible.
Après le déplacement, la fonction redirige sur */map*.
Hint : Pensez à créer les quatre boutons (liens) de déplacement dans le twig de la map.

- Ajouter le champ *$hasTreasure* (bool) dans l'entité Boat. N'oubliez pas les getter / setter et de mettre à jour votre base de donnée.

- Dans TileRepository, créez une méthode *getRandomIsland()* qui renverra une tuile de type island aléatoire. Pour ce faire, vous devrez d'abord récupérer toutes les tuiles de type island dans un tableau, et ensuite retourner une des tuile du tableau de facon aléatoire (en php).

- Dans DefaultController, créer une route */start* qui reset les coordonées du bateau à 0,0. Elle devra aussi remettre le trésor sur une ile aléatoire. Enfin, elle redirigera vers l'url */map*.
Hint : Attention à ne pas mettre plusieurs trésors dans la map ;)

Bonus : end TODO