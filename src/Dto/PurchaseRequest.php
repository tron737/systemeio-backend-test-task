<?php

namespace App\Dto;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Enum\Payment;
use App\Validator\EntityExists;
use App\Validator\TaxNumber;
use Symfony\Component\Validator\Constraints as Assert;

class PurchaseRequest extends CalculatePriceRequest
{
    #[Assert\NotBlank(message: 'Payment processor is required')]
    #[Assert\Choice(callback: [Payment::class, 'values'], message: 'Payment processor must be {{ choices }}')]
    public string $paymentProcessor;
}