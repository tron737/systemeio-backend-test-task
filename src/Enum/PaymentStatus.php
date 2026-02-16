<?php

namespace App\Enum;

enum PaymentStatus: string
{
    case COMPLETED = 'completed';
    case FAILED = 'failed';
}
