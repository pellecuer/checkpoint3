<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Boat;
use AppBundle\Entity\Tile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MapController extends Controller
{
    /**
     * @Route("/map", name="map")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tiles = $em->getRepository(Tile::class)->findAll();
        foreach ($tiles as $tile)
        {
            $map[$tile->getCoordX()][$tile->getCoordY()] = $tile;
        }

        $boat = $em->getRepository(Boat::class)->findAll();

        return $this->render('map/index.html.twig', [
            'map' => $map,
            'boat' => $boat[0],
        ]);
    }

    /**
     * @Route("/map/{x}/{y}", name="moveBoat")
     */
    public function moveBoatAction(int $x, int $y)
    {
        $em = $this->getDoctrine()->getManager();
        $boats = $em->getRepository(Boat::class)->findAll();
        $boat = $boats[0];

        $boat->setCoordX($x);
        $boat->setCoordY($y);

        $em->flush();

        return $this->redirectToRoute('map');
    }
}
