<?php

namespace App\Validator;

use App\Enum\Country;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TaxNumberValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof TaxNumber) {
            throw new UnexpectedTypeException($constraint, TaxNumber::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $country = Country::fromCode($value);

        if ($country === null) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ country }}', substr($value, 0, 2))
                ->addViolation();
            return;
        }

        if (!preg_match($country->getPattern(), $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ country }}', $country->value)
                ->addViolation();
        }
    }
}