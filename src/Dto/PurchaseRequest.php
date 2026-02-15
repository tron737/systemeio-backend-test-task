<?php

namespace App\Dto;

use App\Enum\Payment;
use App\Validator\TaxNumber;
use Symfony\Component\Validator\Constraints as Assert;

class PurchaseRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'Product ID is required')]
        #[Assert\Positive(message: 'Product ID must be positive')]
        public readonly int $product,

        #[Assert\NotBlank(message: 'Tax number is required')]
        #[TaxNumber]
        public readonly string $taxNumber,

        #[Assert\NotBlank(message: 'Payment processor is required')]
        #[Assert\Choice(callback: [Payment::class, 'values'], message: 'Payment processor must be {{ choices }}')]
        public readonly string $paymentProcessor,

        #[Assert\Type('string')]
        public readonly ?string $couponCode = null,
    ) {}
}