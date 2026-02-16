<?php

namespace App\Entity\Embeddable;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Tax
{
    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 4)]
    private ?string $rate = null;

    #[ORM\Column(length: 255)]
    private ?string $numberPattern = null;

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(string $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function getNumberPattern(): ?string
    {
        return $this->numberPattern;
    }

    public function setNumberPattern(string $numberPattern): static
    {
        $this->numberPattern = $numberPattern;

        return $this;
    }

    public function validateTaxNumber(string $taxNumber): bool
    {
        return 1 === preg_match($this->getNumberPattern(), $taxNumber);
    }

    public function calculateTax(float $price): float
    {
        return $price * $this->getRate();
    }
}
