<?php

namespace App\Controller;

use App\Dto\CalculatePriceRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class CalculatePriceController extends AbstractController
{
    #[Route('/calculate-price', name: 'calculate_price', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] CalculatePriceRequest $request
    ): JsonResponse
    {
        return $this->json([]);
    }
}