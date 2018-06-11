<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 08/06/18
 * Time: 10:45
 */

namespace AppBundle\Services;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Boat;
use AppBundle\Entity\Tile;
use AppBundle\Repository\TileRepository;

class MapManager
{



    /**
     * @var TileRepository
     */
    private $tileRepository;


    /**
     * Constructor
     *
     * @param string $em Defined in config.yml
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->tileRepository = $em->getRepository(Tile::class);

    }

    public function tileExists(int $x, int $y) : bool
    {
        // the tile exist if there is one in database...
        return (bool) $this->tileRepository->findOneBy([
            'coordX' => $x,
            'coordY' => $y,
        ]);
    }


    public function getRandomIsland()
    {
        // first get all island tiles in an array
        $arrayIsland = $this->tileRepository->findBy([
            'type' => 'island',
        ]);

        $randomKeyIsland = array_rand($arrayIsland, 1);
        $randomIsland = $arrayIsland[$randomKeyIsland];

        return $randomIsland;

        // return one tile randomly (in php)

        // Look at array_rand() function.

    }

    public function FindTreasureIsland()
    {
        // first get island where treasure is true
        $TreasureIsland = $this->tileRepository->findOneBy([
            'hasTreasure' => true,
        ]);


        return $TreasureIsland;

        // return one tile randomly (in php)

        // Look at array_rand() function.

    }


    public function checkTreasure($boat)
    {
        // first get island where treasure is true
        $TreasureIsland = $this->tileRepository->findOneBy([
            'hasTreasure' => true,
        ]);

        //get Coordinate of the island
        $CoordXIsland = $TreasureIsland->getCoordX();
        $CoordYIsland = $TreasureIsland->getCoordY();

        //check that this boat is on the tile with the treasure
        $CoordXboat = $boat-> getCoordX();
        $CoordYBoat = $boat->getCoordY();

        if ($CoordXboat == $CoordXIsland && $CoordYIsland == $CoordYBoat){
            $isOnTreasureIsland = true;
        }else {
            $isOnTreasureIsland = false;
        }


        return $isOnTreasureIsland;

    }



}


