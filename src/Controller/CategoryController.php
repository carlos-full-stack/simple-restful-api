<?php

namespace App\Controller;

use App\Entity\Category;
use App\Service\DataGenerator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
* @Route("/api", name="api_")
*/

class CategoryController extends AbstractController
{

/**
* @Route("/categories", name="category_index", methods={"GET"})
*/

public function indexCategory(ManagerRegistry $doctrine, DataGenerator $dg): JsonResponse
{
    $categories = $doctrine
        ->getRepository(Category::class)
        ->findAll();

    if (!$categories) return $this->json('There is no categories to list', 404);

    return $this->json($dg->generateCategoryData($categories));
}

/**
* @Route("/category/new", name="category_new", methods={"POST"})
*/

public function newCategory(ManagerRegistry $doctrine, Request $request, ValidatorInterface $validator)
{

    $entityManager = $doctrine->getManager();
    $category = new Category();

    $category->setName($request->request->get('name'));
    $category->setDescription($request->request->get('description'));

    $errors = $validator->validate($category);

    if (count($errors) > 0) {
  
    $errorsString = (string) $errors;
    return new JsonResponse($errorsString);

    }


    $entityManager->persist($category);
    $entityManager->flush();

    return $this->json('New category has been added with id ' . $category->getId());
    
    }

    /**
    * @Route("/category/{id}", name="category_show", methods={"GET"})
    */
    
    public function showCategory(ManagerRegistry $doctrine, DataGenerator $dg, int $id): JsonResponse
    {

        $category = $doctrine
        ->getRepository(Category::class)
        ->find($id);

        if (!$category) return $this->json('category not found by id ' . $id , 404);

        return $this->json($dg->generatecategoryData($category));

    }

    /**
    * @Route("/category/{id}", name="category_edit", methods={"PUT"})
    */

    public function editCategory(ManagerRegistry $doctrine, Request $request, ValidatorInterface $validator, DataGenerator $dg, int $id)
    {
        $entityManager = $doctrine->getManager();
        $category = $entityManager->getRepository(Category::class)->find($id);
  
        $category->setName($request->request->get('name'));
        $category->setDescription($request->request->get('description'));

        $errors = $validator->validate($category);

        if (count($errors) > 0) {

        $errorsString = (string) $errors;
        return new JsonResponse($errorsString);

        }

        $entityManager->flush();
  
        return $this->json($dg->generatecategoryData($category));
     
    }

    /**
    * @Route("/category/{id}", name="category_delete", methods={"DELETE"})
    */

    public function deleteCategory(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $category = $entityManager->getRepository(category::class)->find($id);
  
        if (!$category) return $this->json('category not found by id ' . $id , 404);
  
        $entityManager->remove($category);
        $entityManager->flush();
  
        return $this->json('category deleted with id ' . $id);
    
    }

}