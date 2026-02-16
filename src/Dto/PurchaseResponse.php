<?php

namespace App\Dto;

use App\Enum\PaymentStatus;

readonly class PurchaseResponse extends CalculatePriceResponse
{
    public function __construct(
        float $finalPrice,
        public PaymentStatus $paymentStatus,
    ) {
        parent::__construct($finalPrice);
    }
}
