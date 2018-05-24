<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Boat;
use AppBundle\Entity\Tile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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



}
