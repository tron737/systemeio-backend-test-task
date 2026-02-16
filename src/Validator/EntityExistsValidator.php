<?php

namespace App\Validator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class EntityExistsValidator extends ConstraintValidator
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof EntityExists) {
            throw new UnexpectedTypeException($constraint, EntityExists::class);
        }
        if (null === $value || '' === $value) {
            return;
        }
        if (!is_scalar($value) && !is_array($value)) {
            throw new UnexpectedValueException($value, 'scalar or array');
        }

        if (!class_exists($constraint->entityClass)) {
            throw new \InvalidArgumentException(sprintf('Class "%s" does not exist', $constraint->entityClass));
        }

        $repository = $this->entityManager->getRepository($constraint->entityClass);

        if (!method_exists($repository, $constraint->repositoryMethod)) {
            throw new \InvalidArgumentException(sprintf('Method "%s" does not exist in repository "%s"', $constraint->repositoryMethod, get_class($repository)));
        }

        $entity = $repository->{$constraint->repositoryMethod}($value);

        if (null === $entity) {
            $entityName = substr($constraint->entityClass, strrpos($constraint->entityClass, '\\') + 1);

            $formattedValue = match (true) {
                is_array($value) => implode(', ', $value),
                is_bool($value) => $value ? 'true' : 'false',
                is_float($value) => (string) $value,
                is_int($value) => (string) $value,
                default => (string) $value,
            };

            $this->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ entity }}', $entityName)
                ->setParameter('{{ field }}', $constraint->field ?? 'id')
                ->setParameter('{{ value }}', $formattedValue)
                ->addViolation();
        }
    }
}
