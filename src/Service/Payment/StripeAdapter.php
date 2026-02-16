<?php

namespace App\Service\Payment;

use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class StripeAdapter implements PaymentProcessorInterface
{
    public function process(float $amount): void
    {
        $stripeProcessor = new StripePaymentProcessor();
        if (!$stripeProcessor->processPayment($amount)) {
            throw new \RuntimeException('Stripe payment failed');
        }
    }
}
