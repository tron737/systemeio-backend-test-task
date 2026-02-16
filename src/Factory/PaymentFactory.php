<?php

namespace App\Factory;

use App\Enum\Payment;
use App\Service\Payment\PaymentProcessorInterface;
use App\Service\Payment\PaypalAdapter;
use App\Service\Payment\StripeAdapter;

class PaymentFactory
{
    public function __construct(
        private PaypalAdapter $paypalAdapter,
        private StripeAdapter $stripeAdapter,
    ) {
    }

    public function create(Payment $payment): PaymentProcessorInterface
    {
        return match ($payment) {
            Payment::PAYPAL => $this->paypalAdapter,
            Payment::STRIPE => $this->stripeAdapter,
            default => throw new \RuntimeException(sprintf('Payment processor "%s" is not supported', $payment->value)),
        };
    }
}
