<?php

namespace App\Dto;

readonly class CalculatePriceResponse
{
    public function __construct(
        public float $finalPrice,
    ) {
    }
}
