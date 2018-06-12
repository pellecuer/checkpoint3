<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Boat;
use AppBundle\Entity\Tile;
use AppBundle\Traits\BoatTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Services\MapManager;




class MapController extends Controller
{
    use BoatTrait;

    /**
     * @Route("/map", name="map")
     */
    public function displayMapAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tiles = $em->getRepository(Tile::class)->findAll();

        foreach ($tiles as $tile) {
            $map[$tile->getCoordX()][$tile->getCoordY()] = $tile;
        }

        $boat = $this->getBoat();



        $tileposition = $em->getRepository(Tile::class)->findOneBy([
            'coordX' => $this->getBoat()-> getCoordX(),
            'coordY' => $this->getBoat()->getCoordY(),



        ]);

        $tileType=$tileposition->getType();


        return $this->render('map/index.html.twig', [
            'map'  => $map ?? [],
            'boat' => $boat,
            'tileType' => $tileType,


        ]);
    }

    /**
     * @Route("/start", name="start")
     */
    public function startAction(mapManager $mapManager)
    {
        $em = $this->getDoctrine()->getManager();

        // reset boat coordinates to 0,0
        $boat = $this->getBoat();
        $boat->setCoordX(0);
        $boat->setCoordY(0);

        //remove the treasure from the mapp
        $tileTreasure = $em->getRepository(Tile::class)->findOneBy([
            'hasTreasure' => true,
        ]);

        $tileTreasure->setHasTreasure(false);


        //and put the treasure on a random island
        $randomIsland = $mapManager-> getRandomIsland();
        $randomIsland-> setHasTreasure(true);
        $em->flush();

        return $this->redirectToRoute('map');
    }
}
