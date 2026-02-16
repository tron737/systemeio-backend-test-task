<?php

namespace App\Service\Payment;

use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

class PaypalAdapter implements PaymentProcessorInterface
{
    /**
     * @throws \Exception
     */
    public function process(float $amount): void
    {
        $paypalProcessor = new PaypalPaymentProcessor();
        $paypalProcessor->pay((int) $amount);
    }
}
