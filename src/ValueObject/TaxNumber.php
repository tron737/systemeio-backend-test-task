<?php

namespace App\ValueObject;

readonly class TaxNumber
{
    private string $countryCode;
    private string $number;
    private string $fullNumber;

    public function __construct(string $countryCode, string $number)
    {
        $this->countryCode = strtoupper($countryCode);
        $this->number = $number;
        $this->fullNumber = $this->countryCode.$this->number;
    }

    public static function fromString(string $taxNumber): self
    {
        $taxNumber = trim($taxNumber);

        if (strlen($taxNumber) < 3) {
            throw new \InvalidArgumentException('Tax number must be at least 3 characters long');
        }

        $countryCode = substr($taxNumber, 0, 2);
        $number = substr($taxNumber, 2);

        return new self($countryCode, $number);
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getFullNumber(): string
    {
        return $this->fullNumber;
    }
}
