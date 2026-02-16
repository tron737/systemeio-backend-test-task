<?php

namespace App\Enum;

enum Payment: string
{
    case PAYPAL = 'paypal';
    case STRIPE = 'stripe';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
