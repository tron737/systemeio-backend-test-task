<?php

namespace App\Entity;

use App\Enum\CouponType;
use App\Repository\PercentCouponRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PercentCouponRepository::class)]
class PercentCoupon extends Coupon implements CouponInterface
{
    public function getType(): string
    {
        return CouponType::PERCENT->value;
    }

    public function applyDiscount(float $price): float
    {
        if (null === $this->getValue()) {
            throw new \InvalidArgumentException('Value must be set.');
        }
        $discount = $price * ((float) $this->getValue() / 100);

        return round($price - $discount, 2);
    }
}
