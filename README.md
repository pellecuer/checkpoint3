# PHP Checkpoint 3

## Installation du projet
- Clone le dépot [URL]
- Lance *composer install*
- Replis les informations dans le *parameters.php*. La base de données à utiliser doit s'appeller impérativement **checkpoint_3**.
- Lance le projet sur l'url `http://localhost:8000`. Tu dois voir une page présentant le sujet du checkpoint et toutes les instructions à suivre (à la lettre, bien enterndu ;-))

==========
## Instructions (à mettre sur la homepage)

- Lis tous le sujet avant de commencer à coder ;)

- Dans la navbar, tu peux accéder à un lien "Map" (url /map). Le Black Pearl peut se déplacer sur cette carte qui est composée de tuiles (Entité Tile). Chaque tuile étant identifiée par des coordonées (x, y) et par un type (mer, port, ile). Le bateau (Entity Boat) possède également des coordonnées permettant d'afficher sa position sur la carte. 

- Pour le moment, il n'y a aucune information en base de données (pas de bateau ni de tuile) : Jack n'a pas encore pris la mer ! Pour commencer, tu vas donc devoir remplir la base de données. Heureusement, nous t'avons préparé des fixtures ! Lance la commande `bin/console ...`. Valide la question, ça y est, tes données sont chargées.

//Vous pouvez récupérer le bateau de Jack dans les controllers grace à la méthode *$this->getBoat()*.

- Une fois sur la page map, tu peux déplacer ton bateau en utilisant la méthode du BoatController  moveBoatAction (déjà existante). Comme tu peux le voir dans le code, il suffit d'utiliser la route /boat/move/x/y (avec x et y les coordonnées où déplacer le bateau) pour que le Black Pearl se rende sur la tuile voulue. La méthode redirige automatiquement vers l'affichage de la map.

- Ajoute dans la vue map, dans le div avec la classe "infos", les informations suivantes :
    - coord x, coordy
    - type de tuile
    - nom de la tuile (une tuile peut avoir un nom optionnel, par exemple le nom du port, de l'ile, etc.)
    
- Pour le moment, si tu cherches à déplacer ton bateau sur une tuile inexistante, le bateau disparaît de la carte et aucune erreur ne s'affiche. Pour éviter à Jack de se perdre, tu vas devoir empêcher les déplacement en dehors des coordonnées de la carte.

    Crée un service *MapManager* dans le dossier /src/Services, et code y une fonction tileExists(int $x, int $y) : bool, dont le but sera de tester si la tuile de coordonnées $x, $y existe bel et bien.
 Hint : Penses à utiliser TileRepository dans ton service.
 
- Une fois la méthode tileExists créée, utilises là dans moveBoat() afin de renvoyer une erreur (et empêcher le déplacement) si les coordonnées de destination n'existent pas.
HINT : utilise les flash messages pour gérer l'erreur. L'affichage des messages flash est déjà implémentée dans le base.html.twig.

- La méthode moveBoat fonctionne bien, cependant elle n'est pas représentative d'un véritable déplacement. Dans BoatController, crée une méthode moveDirectionAction() prenant en paramètre une direction qui peut être *N*, *S*, *E* ou *W*. Par exemple, */boat/move/W*. Une direction non autorisé dans l'url, par exemple *A*, devra générer un message d'erreur (flash). 
    Hint : Pense à utiliser les requirements directement dans l'annotation de la route.

    La méthode devra bouger le bateau dans la bonne direction. 
    
- Tu devras également utiliser la méthode tileExists de ton service pour afficher un message d'erreur si le déplacement est impossible.
Après le déplacement, la fonction redirige sur */map*.

Hint : Pense à créer quatre liens dans le twig de la map pour effectuer les 4 déplacements possibles. Fais cela dans la div de classe 'navigation'.

- Ajouter le champ *$hasTreasure* (bool) dans l'entité Tile. Cela permettra d'indiquer si le trésor se trouve ou non sur la Tile en question. N'oublie pas de générer les getter / setter et de mettre à jour ta base de donnée.

- Dans TileRepository, créez une méthode *getRandomIsland()* qui renverra une tuile de type island aléatoire. Pour ce faire, vous devrez d'abord récupérer toutes les tuiles de type island dans un tableau, et ensuite retourner une des tuiles du tableau de facon aléatoire (en php).

- Dans MapController, créer une méthode startAction (relié à la route */start*) qui lance une nouvelle chasse au trésor. 
    La méthode doit reset les coordonées du bateau à 0,0. Elle devra aussi remettre le trésor sur une ile aléatoire. Enfin, elle redirigera vers l'url */map*, la chasse peut alors commencer !
Hint : Attention il ne peut y avoir qu'un seul trésor dans la map, pense donc à retirer le trésor avant de le réaffecter à une nouvelle Tile ;)

- Dans le service MapManager, créer une méthode checkTreasure(). Cette méthode doit vérifier si le bateau se trouve sur la Tile contenant le trésor et renvoyer un boolean. 

- La méthode doit être appelée à chaque déplacement du bateau. Si elle renvoie true, un message flash de success doit s'afficher. 

Bonus : end TODO