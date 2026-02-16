<?php

namespace App\Entity;

use App\Enum\CouponType;
use App\Repository\FixedCouponRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FixedCouponRepository::class)]
class FixedCoupon extends Coupon implements CouponInterface
{
    public function getType(): string
    {
        return CouponType::FIXED->value;
    }

    public function applyDiscount(float $price): float
    {
        return max(0, $price - $this->getValue());
    }
}
