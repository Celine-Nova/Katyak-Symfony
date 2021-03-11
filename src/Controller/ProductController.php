<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product")
     */
    public function index(ProductRepository $productRepo, PaginatorInterface $paginator, Request $request)
    {   
        //Je récupere mes produits
        $productList = $productRepo->findAll();
        //je créée une pagination grâce au Bundle Paginator cf https://github.com/KnpLabs/KnpPaginatorBundle
        $pagination = $paginator->paginate(
            $productList,
            //request par defaut de la doc
            $request->query->getInt('page', 1),
            8 //limit de nombre d'element paar page
        );
       

        return $this->render('product/index.html.twig', [
            // 'product_List' => $productList,
            //Je retourne la pagination à la vue au lieu de la liste des produits
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/product/{id}", name="product_show", requirements={"id"="\d+"})
     */
    public function show(Product $product)
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);

    }
}
