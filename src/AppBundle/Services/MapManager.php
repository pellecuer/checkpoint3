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
    }




    public function checkTreasure($boat)
    {

        // first get island where treasure is true
        $TreasureIsland = $this->tileRepository->findOneBy([
            'hasTreasure' => true,
        ]);


        if ($boat-> getCoordX() == $TreasureIsland->getCoordX() && $boat->getCoordY() == $TreasureIsland->getCoordY()){
            $isOnTreasureIsland = true;
        }else {
            $isOnTreasureIsland = false;
        }


        return $isOnTreasureIsland;

    }



}


