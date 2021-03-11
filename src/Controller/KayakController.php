<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class KayakController extends AbstractController
{
    /**
     * @Route("product/kayaks", name="kayaks")
     */
    // Je recupère tous les produits de catégorie Kayak avec une requete (Query Builder)  personnalisée avec jointure
    public function index(ProductRepository $Repokayaks)
    {
        $kayakList = $Repokayaks->findByCategoryName('Kayak');
       
        return $this->render('kayak/index.html.twig', [
            'kayak_list' => $kayakList,
        ]);
    }

     /**
     * @Route("product/kayaks/sea", name="sea_kayak")
     */
    // Je récupère les kayak par leur categorie avec une requete (Query Builder) personnalisée avec jointure
    public function sea(ProductRepository $Repoboats){

        $kayakList = $Repoboats->findByTypeName('Mer');
        return $this->render('kayak/sea.html.twig', [
            'kayak_list' => $kayakList,
        ]);
    }

     /**
     * @Route("product/kayaks/river", name="river_kayak")
     */
    // Je récupère les kayaks par leur type avec une requetre (Query Builder) personnalisée avec jointure

    public function river(ProductRepository $Repoboats){

        $kayakList = $Repoboats->findByTypeName('Rivière');
        return $this->render('Kayak/river.html.twig', [
            'kayak_list' => $kayakList,
        ]);
    }
}
