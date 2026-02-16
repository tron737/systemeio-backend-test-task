<?php

namespace App\Dto;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Validator\EntityExists;
use App\Validator\TaxNumber;
use Symfony\Component\Validator\Constraints as Assert;

class CalculatePriceRequest
{
    #[Assert\NotBlank(message: 'Product ID is required')]
    #[Assert\Positive(message: 'Product ID must be positive')]
    #[EntityExists(
        entityClass: Product::class,
        repositoryMethod: 'find',
        message: 'Product with ID "{{ value }}" does not exist',
        field: 'id'
    )]
    public int $product;

    #[Assert\NotBlank(message: 'Tax number is required')]
    #[TaxNumber]
    public string $taxNumber;

    #[Assert\Type('string')]
    #[Assert\NotBlank(message: 'Coupon code cannot be empty', allowNull: false)]
    #[EntityExists(
        entityClass: Coupon::class,
        repositoryMethod: 'findByCode',
        message: 'Coupon "{{ value }}" does not exist',
        field: 'code'
    )]
    public ?string $couponCode;
}
