<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\ProductGenerator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/api", name="api_")
*/

class ProductController extends AbstractController
{

/**
* @Route("/products", name="product_index", methods={"GET"})
*/
    public function indexProduct(ManagerRegistry $doctrine, ProductGenerator $pg): JsonResponse
    {
        $products = $doctrine
            ->getRepository(Product::class)
            ->findAll();

        if (!$products) return $this->json('There is no products to list', 404);
  
        return $this->json($pg->generateProductData($products));
    }


/**
* @Route("/product/{id}", name="product_show", methods={"GET"})
*/
    public function showProduct(ManagerRegistry $doctrine, ProductGenerator $pg, int $id): JsonResponse
    {
        $product = $doctrine
        ->getRepository(Product::class)
        ->find($id);
  
        if (!$product) return $this->json('Product not found by id ' . $id , 404);
    

        return $this->json($pg->generateProductData($product));

    }

/**
* @Route("/product/{id}", name="product_edit", methods={"PUT"})
*/

    public function editProduct(ManagerRegistry $doctrine, Request $request, ProductGenerator $pg, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);
  
        if (!$product) return $this->json('Product not found by id ' . $id , 404);

  
        $product->setName($request->request->get('name'));
        $product->setDescription($request->request->get('description'));
        $entityManager->flush();
  
        return $this->json($pg->generateProductData($product));
     
    }

/**
* @Route("/product/{id}", name="product_delete", methods={"DELETE"})
*/

    public function deleteProduct(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);
  
        if (!$product) return $this->json('Product not found by id ' . $id , 404);
  
        $entityManager->remove($product);
        $entityManager->flush();
  
        return $this->json('Product deleted with id ' . $id);
    
    }



}
