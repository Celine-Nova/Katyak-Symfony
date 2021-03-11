<?php

namespace App\Controller\Backend;

use App\Entity\Product;
use App\Form\ProductFormType;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/backend/product", name="backend_")
 */

class ProductController extends AbstractController
{
    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     */
    public function productNew(Request $request, FileUploader $fileUploader)
    {
        $product = new Product();
        $formProduct = $this->createForm(ProductFormType::class, $product);

        // 'handleRequest' traite les données par defaut UNIQUEMENT si il s'agit d'une requete POST
        $formProduct->handleRequest($request);

        if ($formProduct->isSubmitted() && $formProduct->isValid()) {
            // 1. Si  GET  isSumitted retourne 'false', continue et renvoie le formulaire vide à Twig
            // 2. Si POST alors 'handleRequest' traite les donnéees si elle sont correctes alors retourne 'true' et envoie a isValid pour la validation des données
            // 3.Si 'isValid' est 'false' alors retourne le formulaire à twig mais avec des ERREURS
            
            //Je recupère les données
            $product = $formProduct->getData();
            
            
                    $pictureFile = $formProduct['picture']->getData();
                    if ($pictureFile) {
                        $pictureFileName = $fileUploader->upload($pictureFile);
                        $product->setPicture($pictureFileName);
                    }
           
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);//declenche l'evenement PrePersist OU PostPersist 
            $entityManager->flush();// declenche l'evenement PreFlush
          
            // Si bien enregistré j'affiche un message
            $this->addFlash(
                'success',
                'Enregistrement effectué'
            );
            // Et je redirige ver l'accueil
            return $this->redirectToRoute('product');
        }

        return $this->render('backend/product/new.html.twig', [
            // 'product' => $product,
            'form_Product' => $formProduct->createView(),
        ]);
    }
    /**
     * @Route("/edit/{id}", name="product_edit", methods={"GET","POST"})
     */
    public function updateProduct(Product $product, FileUploader $fileUploader, Request $request){
        
        $formProduct = $this->createForm(ProductFormType::class, $product);
        $formProduct->handleRequest($request);

        if ($formProduct->isSubmitted() && $formProduct->isValid()) {
            if(!is_null($product->getPicture())){

                $pictureFile = $formProduct['picture']->getData();
                    if ($pictureFile) {
                        $pictureFileName = $fileUploader->upload($pictureFile);
                        $product->setPicture($pictureFileName);
                    }
               
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);//declenche l'evenement PrePersist OU PostPersist 
            $entityManager->flush();// declenche l'evenement PreFlush
          
            // Si bien enregistré j'affiche un message
            $this->addFlash(
                'success',
                'Mise à jour effectuée'
            );
            // Et je redirige ver le produit en question
            return $this->redirectToRoute('product_show', [
                'id' => $product->getId(),
            ]);
        }

        return $this->render('backend/product/edit.html.twig', [
            // 'product' => $product,
            'form_Product' => $formProduct->createView(),
        ]);
    }
    

}
