<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create 5 categories

        for ($i = 0; $i < 5; $i++) {
            $product = new Category();
            $product->setName('Category '.$i);
            $product->setDescription('Category description');
            $manager->persist($product);
        }

        // Create 5 categories

        for ($i = 0; $i < 5; $i++) {
            $product = new Product();
            $product->setName('Product '.$i);
            $product->setDescription('Product description');
            $product->setWeight(mt_rand(0, 100) . 'kg');
            $product->setIsAvailable(mt_rand(0, 1));
            $product->setQty(mt_rand(0, 1000));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
