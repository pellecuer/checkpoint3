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
        $CoordX = $this->getBoat()-> getCoordX();
        $CoordY = $this->getBoat()->getCoordY();

        $position = $em->getRepository(Tile::class)->findOneBy([
            'coordX' => $CoordX,
            'coordY' => $CoordY,



        ]);

        $boatType=$position->getType();


        return $this->render('map/index.html.twig', [
            'map'  => $map ?? [],
            'boat' => $boat,
            'CoordX' => $CoordX,
            'CoordY' => $CoordY,
            'BoatType' => $boatType,


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
        $em->flush();


        //remove the treasure from the mapp
        $tiles = $em->getRepository(Tile::class)->findAll();
        foreach ($tiles as $tile) {
            [$tile->setHasTreasure(false)];

            $em->flush();
        }


        //and put the treasure on a random island
        $randomIsland = $mapManager-> getRandomIsland();
        $randomIsland-> setHasTreasure(true);
        $em->flush();


        return $this->redirectToRoute('map');

    }
}
