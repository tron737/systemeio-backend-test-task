<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $items = [
            [
                'code' => 'DE',
                'name' => 'Germany',
                'rate' => '0.19',
                'numberPattern' => '/^DE\d{9}$/',
            ],
            [
                'code' => 'IT',
                'name' => 'Italy',
                'rate' => '0.22',
                'numberPattern' => '/^IT\d{11}$/',
            ],
            [
                'code' => 'GR',
                'name' => 'Greece',
                'rate' => '0.24',
                'numberPattern' => '/^GR\d{9}$/',
            ],
            [
                'code' => 'FR',
                'name' => 'France',
                'rate' => '0.20',
                'numberPattern' => '/^FR[A-Z]{2}\d{9}$/',
            ],
        ];

        foreach ($items as $item) {
            $country = new Country();
            $country->setCode($item['code'])
                ->setName($item['name'])
                ->getTax()
                ->setRate($item['rate'])
                ->setNumberPattern($item['numberPattern']);
            $manager->persist($country);
        }

        $manager->flush();
    }
}
