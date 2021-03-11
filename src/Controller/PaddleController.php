<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaddleController extends AbstractController
{
    /**
     * @Route("product/paddle", name="paddle")
     */
    public function index(ProductRepository $paddleRepo, CategoryRepository $categoryPaddle)
    {
        //Recuperer la liste des Paddle
        //Methdoe1
        // $paddle = $categoryPaddle->findBy(['name' => 'Paddle']);
        //  dump($paddle);
        //$paddle_list = $paddleRepo->findByCategoryName($paddle->getName());

        //Methode 2
        $paddle_list = $paddleRepo->findByCategoryName('Paddle');
        //   dd($paddle_list);

        return $this->render('paddle/index.html.twig', [
            'paddle_list' => $paddle_list,
        ]);
    }
}
