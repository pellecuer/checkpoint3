# PHP Checkpoint 3

##Fourni aux élèves :
- Structure de Symfony
- methode map (route /map)
    => afficher la map
    => afficher le bateau sur la map    
- methode moveBoatAction(x,y)
    => en get, deplacement du bateau
    
- entité Tile
    - type (mer, ile, port...)
    - coordX
    - coordY
    - name
    - (isTreasure) à créer par l'élève
- entité Boat
    - name
    - coordX
    - coordY
    - (gold) à voir
    - (health) à voir
- faire des fixtures ou livrer une BDD ?
    
## A faire par l'élève :
- créer la méthode moveDirectionAction($direction)  ($direction = N,S,E,W)
    => bouger le bateau dans la bonne direction
    => pas possible si bord de la carte 
    => dans un service ?
- créer la méthode startGame() 
    => bateau coord 0
    => trésor sur une ile aléatoire 

- créer la méthode endGame(Boat $boat)
    => ajouter la prop isTreasure dans l'entité Tile
    => si le bateau est sur la case du trésor
    => redirection vers page proposant new Game avec message de félicitations

- créer la méthode fightAction($boat) (rencontre avec un bateau ennemi)
    => déclenchement alétoire 33% de chance, si la Tile est de type "sea"
    => perte de xx PV ou gain de xx PO

- créer la méthode repair($boat)
    => restauration de PV contre PO
    => uniquement dans les ports
    
- Créer une entité Crew + générer le CRUD associé
    - name
    - role (capitaine, moussaillon...)
    - boat (créer une ManyToOne bidir)

 