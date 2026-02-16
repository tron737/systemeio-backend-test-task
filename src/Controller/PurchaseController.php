<?php

namespace App\Controller;

use App\Dto\PurchaseRequest;
use App\Dto\PurchaseResponse;
use App\Enum\Payment;
use App\Enum\PaymentStatus;
use App\Factory\PaymentFactory;
use App\Service\PriceCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class PurchaseController extends AbstractController
{
    public function __construct(
        private readonly PriceCalculator $priceCalculator,
        private readonly PaymentFactory $paymentFactory,
    ) {
    }

    #[Route('/purchase', name: 'purchase', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] PurchaseRequest $request,
    ): JsonResponse {
        $finalPrice = $this->priceCalculator->calculate(
            $request->product,
            $request->taxNumber,
            $request->couponCode
        );

        $this->paymentFactory->create(Payment::from($request->paymentProcessor))->process($finalPrice);

        return $this->json(new PurchaseResponse($finalPrice, PaymentStatus::COMPLETED));
    }
}
