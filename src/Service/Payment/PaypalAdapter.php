<?php

namespace App\Service\Payment;

use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

class PaypalAdapter implements PaymentProcessorInterface
{
    public function __construct(private PaypalPaymentProcessor $paypalPaymentProcessor)
    {
    }

    /**
     * @throws \Exception
     */
    public function process(float $amount): void
    {
        $this->paypalPaymentProcessor->pay((int) $amount);
    }
}
