<?php

namespace App\Dto;

readonly class PriceCalculationResponse
{
    public function __construct(
        public float $finalPrice,
    ) {
    }
}
