<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\DataGenerator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api", name="search")
 */


class SearchController extends AbstractController
{

/**
* @Route("/search/id/{id}", name="search_id", methods={"GET"})
*/

    public function searchProductById(ManagerRegistry $doctrine, DataGenerator $DataGenerator, int $id): JsonResponse
    {
        $product = $doctrine->getRepository(Product::class)->find($id);
  
        if (!$product) return $this->json('No product found for id ' . $id, 404);
        
        return $this->json($DataGenerator->generateProductData($product));
    }


/**
* @Route("/search/name/{name}", name="search_name", methods={"GET"})
*/

     public function searchProductByName(ManagerRegistry $doctrine, DataGenerator $DataGenerator, string $name)
     {

        $product = $doctrine->getRepository(Product::class)->findBy(array('name' => $name));
        
        if (!$product) return $this->json('No product found for name ' . $name, 404);

    
        return $this->json($DataGenerator->generateProductData($product));
    }

/**
* @Route("/search/desc/{desc}", name="search_desc", methods={"GET"})
*/


     public function searchProductByDesc(ManagerRegistry $doctrine, DataGenerator $dg, $DataGenerator, string $desc)
     {

        $product = $doctrine->getRepository(Product::class)->findBy(array('description' => $desc));

        if (!$product) return $this->json('No product found by description ' . $desc, 404);

        return $this->json($dg->generateProductData($product));
            

     }



}
