<?php

namespace App\Service;

use App\Repository\CouponRepository;

class CouponService
{
    public function __construct(
        private readonly CouponRepository $couponRepository,
    ) {
    }

    public function applyCoupon(?string $couponCode, float $price): float
    {
        if (null === $couponCode || '' === $couponCode) {
            return $price;
        }

        $coupon = $this->couponRepository->findOneBy(['code' => $couponCode]);

        if (!$coupon) {
            throw new \InvalidArgumentException(sprintf('Coupon(%s) not found', $couponCode));
        }

        return $coupon->applyDiscount($price);
    }
}
