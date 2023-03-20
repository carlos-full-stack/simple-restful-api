<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\ProductGenerator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
}
