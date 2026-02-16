<?php

namespace App\Service;

use App\Repository\ProductRepository;

class PriceCalculator
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly TaxCalculator $taxCalculator,
        private readonly CouponService $couponService,
    ) {
    }

    public function calculate(int $productId, $taxNumber, ?string $couponCode = null): float
    {
        $product = $this->productRepository->find($productId);

        if (!$product) {
            throw new \InvalidArgumentException(sprintf('Product(%s) not found', $taxNumber->getCountryCode()));
        }

        $priceAfterDiscount = $this->couponService->applyCoupon($couponCode, $product->getPrice());

        $tax = $this->taxCalculator->calculate($taxNumber, $priceAfterDiscount);

        return $priceAfterDiscount + $tax;
    }
}
