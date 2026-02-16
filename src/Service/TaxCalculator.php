<?php

namespace App\Service;

use App\Repository\CountryRepository;

class TaxCalculator
{
    public function __construct(
        private readonly CountryRepository $countryRepository,
    ) {
    }

    public function calculate(\App\ValueObject\TaxNumber $taxNumber, float $price): float
    {
        $country = $this->countryRepository->findOneBy(['code' => $taxNumber->getCountryCode()]);

        if (!$country) {
            throw new \InvalidArgumentException(sprintf('Unsupported country: %s', $taxNumber->getCountryCode()));
        }

        return $country->getTax()->calculateTax($price);
    }
}
