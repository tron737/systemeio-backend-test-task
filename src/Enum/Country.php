<?php

namespace App\Enum;

enum Country: string
{
    case GERMANY = 'DE';
    case ITALY = 'IT';
    case GREECE = 'GR';
    case FRANCE = 'FR';

    public function getTaxRate(): float
    {
        return match($this) {
            self::GERMANY => 0.19,
            self::ITALY => 0.22,
            self::GREECE => 0.24,
            self::FRANCE => 0.20,
        };
    }

    public function getPattern(): string
    {
        return match($this) {
            self::GERMANY => '/^DE\d{9}$/',
            self::ITALY => '/^IT\d{11}$/',
            self::GREECE => '/^GR\d{9}$/',
            self::FRANCE => '/^FR[A-Z]{2}\d{9}$/',
        };
    }

    public static function fromCode(string $code): ?self
    {
        return self::tryFrom(strtoupper(substr($code, 0, 2)));
    }
}
