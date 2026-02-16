<?php

namespace App\Validator;

use App\Repository\CountryRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TaxNumberValidator extends ConstraintValidator
{
    public function __construct(
        private readonly CountryRepository $countryRepository,
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof TaxNumber) {
            throw new UnexpectedTypeException($constraint, TaxNumber::class);
        }

        if (!$value instanceof \App\ValueObject\TaxNumber) {
            return;
        }

        $country = $this->countryRepository->findOneBy(['code' => $value->getCountryCode()]);

        if (!$country) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ country }}', $value->getCountryCode())
                ->addViolation();

            return;
        }

        if (!$country->getTax()->validateTaxNumber($value->getFullNumber())) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ country }}', (string) $country->getCode())
                ->addViolation();
        }
    }
}
