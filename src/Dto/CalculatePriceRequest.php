<?php

namespace App\Dto;

use App\Validator\TaxNumber;
use Symfony\Component\Validator\Constraints as Assert;

class CalculatePriceRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'Product ID is required')]
        #[Assert\Positive(message: 'Product ID must be positive')]
        public readonly int $product,

        #[Assert\NotBlank(message: 'Tax number is required')]
        #[TaxNumber]
        public readonly string $taxNumber,

        #[Assert\Type('string')]
        public readonly ?string $couponCode = null,
    ) {}
}