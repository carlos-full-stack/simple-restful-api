<?php

namespace App\Service;

class ProductGenerator

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

                ];
            }

        } else {

            return [
                'id' => $products->getId(),
                'name' => $products->getName(),
                'description' => $products->getDescription(),
                'description' => $products->getDescription(),
                'weight' => $products->getWeight(),
                'isAvailable' => $products->isIsAvailable(),
                'qty' => $products->getQty(),
                'image' => $products->getImage(),
            ];


        }
            return $productData;
    }
}