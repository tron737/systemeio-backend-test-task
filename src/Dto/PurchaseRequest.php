<?php

namespace App\Dto;

use App\Enum\Payment;
use Symfony\Component\Validator\Constraints as Assert;

class PurchaseRequest extends CalculatePriceRequest
{
    #[Assert\NotBlank(message: 'Payment processor is required')]
    #[Assert\Choice(callback: [Payment::class, 'values'], message: 'Payment processor must be {{ choices }}')]
    public string $paymentProcessor;
}
