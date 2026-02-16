<?php

namespace App\Service\Payment;

use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class StripeAdapter implements PaymentProcessorInterface
{
    public function __construct(private readonly StripePaymentProcessor $stripePaymentProcessor)
    {
    }

    public function process(float $amount): void
    {
        if (!$this->stripePaymentProcessor->processPayment($amount)) {
            throw new \RuntimeException('Stripe payment failed');
        }
    }
}
