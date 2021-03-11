<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BoatController extends AbstractController
{
    /**
     * @Route("product/boats", name="boats")
     */
    public function index(ProductRepository $Repoboats)
    {
        $boatList = $Repoboats->findByCategoryName('Bâteaux');
       
        return $this->render('boat/index.html.twig', [
            'boat_list' => $boatList,
        ]);
    }

     /**
     * @Route("product/boats/motor", name="motor_boats")
     */
    // Je récupère les bâteaux par leur categorie avec une requetre (Query Builder) personnalisée avec jointure
    public function motorBoat(ProductRepository $Repoboats){

        $boatList = $Repoboats->findByTypeName('Moteur');
        return $this->render('boat/motor.html.twig', [
            'boat_list' => $boatList,
        ]);
    }

     /**
     * @Route("product/boats/sailing_ship", name="sailing_ship")
     */
    // Je récupère les bâteaux par leur type avec une requetre (Query Builder) personnalisée avec jointure

    public function sailingShip(ProductRepository $Repoboats){

        $boatList = $Repoboats->findByTypeName('Voile');
        return $this->render('boat/sailing_ship.html.twig', [
            'boat_list' => $boatList,
        ]);
    }
}
