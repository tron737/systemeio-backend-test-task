<?php

namespace App\Entity;

interface CouponInterface
{
    public function getType(): string;

    public function applyDiscount(float $price): float;
}
