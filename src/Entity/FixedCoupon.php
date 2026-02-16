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
        if (null === $this->getValue()) {
            throw new \InvalidArgumentException('Value must be set.');
        }

        return max(0, round($price - (float) $this->getValue(), 2));
    }
}
