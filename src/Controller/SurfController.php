<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SurfController extends AbstractController
{
    /**
     * @Route("/surf", name="surf")
     */
    public function index(ProductRepository $surfRepo)
    {
        $surf_list = $surfRepo->findByCategoryName('Planche de surf');
        return $this->render('surf/index.html.twig', [
            'surf_list' => $surf_list,
        ]);
    }
}
