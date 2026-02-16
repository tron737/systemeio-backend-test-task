<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class TaxNumber extends Constraint
{
    public string $message = 'Invalid tax number format for country "{{ country }}".';
}
