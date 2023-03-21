<?php

namespace App\Controller;

use App\Entity\Category;
use App\Service\DataGenerator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/api", name="api_")
*/

class CategoryController extends AbstractController
{

/**
* @Route("/categories", name="category_index", methods={"GET"})
*/

public function indexProduct(ManagerRegistry $doctrine, DataGenerator $dg): JsonResponse
{
    $categories = $doctrine
        ->getRepository(Category::class)
        ->findAll();

    if (!$categories) return $this->json('There is no categories to list', 404);

    return $this->json($dg->generateCategoryData($categories));
}

}
