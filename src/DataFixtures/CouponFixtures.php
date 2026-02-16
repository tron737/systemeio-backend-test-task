<?php

namespace App\DataFixtures;


use App\Entity\Coupon;
use App\Entity\FixedCoupon;
use App\Entity\PercentCoupon;
use App\Enum\CouponType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CouponFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $items = [
            [
                'code' => 'FIXED10',
                'type' => CouponType::FIXED,
                'value' => 10.00
            ],
            [
                'code' => 'PERCENT20',
                'type' => CouponType::PERCENT,
                'value' => 20.00
            ],
            [
                'code' => 'SAVE15',
                'type' => CouponType::PERCENT,
                'value' => 15.00
            ],
            [
                'code' => 'BIG50',
                'type' => CouponType::FIXED,
                'value' => 50.00
            ],
        ];

        foreach ($items as $item) {
            $coupon = $item['type'] === CouponType::FIXED ? new FixedCoupon() : new PercentCoupon();
            $coupon
                ->setCode($item['code'])
                ->setValue($item['value']);
            $manager->persist($coupon);
        }

        $manager->flush();
    }
}