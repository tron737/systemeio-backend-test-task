<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $items = [
            [
                'name' => 'iPhone 14',
                'price' => 999.99,
            ],
            [
                'name' => 'Wireless Headphones',
                'price' => 199.50,
            ],
            [
                'name' => 'Phone Case',
                'price' => 19.99,
            ],
            [
                'name' => 'MacBook Pro 16"',
                'price' => 2499.00,
            ],
            [
                'name' => 'Smart Watch',
                'price' => 349.99,
            ],
        ];

        foreach ($items as $item) {
            $product = new Product();
            $product
                ->setName($item['name'])
                ->setPrice($item['price']);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
