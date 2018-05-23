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
    public function displayMapAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tiles = $em->getRepository(Tile::class)->findAll();

        foreach ($tiles as $tile)
        {
            $map[$tile->getCoordX()][$tile->getCoordY()] = $tile;
        }

        $boat = $em->getRepository(Boat::class)->findOneBy([]);

        return $this->render('map/index.html.twig', [
            'map' => $map ?? [],
            'boat' => $boat,
        ]);
    }


    /**
     * Move the boat to coord x,y
     * @Route("/map/{x}/{y}", name="moveBoat", requirements={"x"="\d+", "y"="\d+"}))
     */
    public function moveBoatAction(int $x, int $y)
    {
        $em = $this->getDoctrine()->getManager();
        $boat = $em->getRepository(Boat::class)->findOneBy([]);

        $boat->setCoordX($x);
        $boat->setCoordY($y);

        $em->flush();

        return $this->redirectToRoute('map');
    }
}
