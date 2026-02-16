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

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof TaxNumber) {
            throw new UnexpectedTypeException($constraint, TaxNumber::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $countryCode = substr($value, 0, 2);
        $country = $this->countryRepository->findOneBy(['code' => $countryCode]);

        if (!$country) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ country }}', $countryCode)
                ->addViolation();

            return;
        }

        if (!$country->getTax()->validateTaxNumber($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ country }}', $country->getCode())
                ->addViolation();
        }
    }
}
