<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Service\DataGenerator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;

/**
* @Route("/api", name="api_")
*/

class ProductController extends AbstractController
{

/**
* @Route("/products", name="product_index", methods={"GET"})
*/
    public function indexProduct(ManagerRegistry $doctrine, DataGenerator $dg)
    {

        $products = $doctrine
            ->getRepository(Product::class)
            ->findAll();

        if (!$products) return $this->json('There is no products to list', 404);

        return $this->json($dg->generateProductData($products));
    }


/**
* @Route("/product/new", name="product_new", methods={"POST"})
*/

    public function newProduct(ManagerRegistry $doctrine, Request $request, ValidatorInterface $validator)
    {
        $entityManager = $doctrine->getManager();
        $product = new Product();

        $product->setName($request->request->get('name'));
        $product->setDescription($request->request->get('description'));
        $product->setWeight($request->request->get('weight'));
        $product->setIsAvailable($request->request->get('isAvailable'));
        $product->setQty($request->request->getInt('qty'));
        $product->setImage($request->request->get('image'));
        $category = $entityManager->getRepository(Category::class)->find($request->request->get('category'));
        $product->setCategory($category);

        $errors = $validator->validate($product);

        if (count($errors) > 0) {
       
        $errorsString = (string) $errors;
        return new Response($errorsString);

        }


        $entityManager->persist($product);
        $entityManager->flush();

        return $this->json('New product has been added with id ' . $product->getId());
    }


/**
* @Route("/product/{id}", name="product_show", methods={"GET"})
*/
    public function showProduct(ManagerRegistry $doctrine, DataGenerator $dg, int $id): JsonResponse
    {
        $product = $doctrine
        ->getRepository(Product::class)
        ->find($id);
  
        if (!$product) return $this->json('Product not found by id ' . $id , 404);

        return $this->json($dg->generateProductData($product));

    }

/**
* @Route("/product/{id}", name="product_edit", methods={"PUT"})
*/

    public function editProduct(ManagerRegistry $doctrine, Request $request, ValidatorInterface $validator, DataGenerator $dg, int $id)
    {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);
  
        $product->setName($request->request->get('name'));
        $product->setDescription($request->request->get('description'));
        $product->setWeight($request->request->get('weight'));
        $product->setIsAvailable($request->request->get('isAvailable'));
        $product->setQty($request->request->getInt('qty'));
        $product->setImage($request->request->get('image'));
        $category = $entityManager->getRepository(Category::class)->find($request->request->get('category'));
        $product->setCategory($category);

        $errors = $validator->validate($product);

        if (count($errors) > 0) {

        $errorsString = (string) $errors;
        return new Response($errorsString);

        }

        $entityManager->flush();
  
        return $this->json($dg->generateProductData($product));
     
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
