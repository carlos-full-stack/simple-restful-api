<?php

namespace App\Service;

class DataGenerator

{

    public function generateProductData($products)
    {        
        
        $productData = [];

        if (is_Array($products)) 
        
        {

            foreach ($products as $product) {
                $productData[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'weight' => $product->getWeight(),
                'isAvailable' => $product->isIsAvailable(),
                'qty' => $product->getQty(),
                'image' => $product->getImage(),
                'category' => $product->getCategory()->getId(),

                ];
            }

        } else {

            return [
                'id' => $products->getId(),
                'name' => $products->getName(),
                'description' => $products->getDescription(),
                'weight' => $products->getWeight(),
                'isAvailable' => $products->isIsAvailable(),
                'qty' => $products->getQty(),
                'image' => $products->getImage(),
                'category' => $products->getCategory()->getId(),
            ];


        }
            return $productData;
    }


    public function generateCategoryData($products)
    {        
        
        $productData = [];

        if (is_Array($products)) 
        
        {

            foreach ($products as $product) {
                $productData[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription()

                ];
            }

        } else {

            return [
                'id' => $products->getId(),
                'name' => $products->getName(),
                'description' => $products->getDescription(),

            ];


        }
            return $productData;
    }
}