<?php

namespace App\Controller;

use App\Dto\PurchaseRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class PurchaseController extends AbstractController
{
    #[Route('/purchase', name: 'purchase', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] PurchaseRequest $request,
    ): JsonResponse {
        return $this->json([]);
    }
}
