<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class EntityExists extends Constraint
{
    public function __construct(
        public string $entityClass,
        public string $repositoryMethod = 'find',
        public string $message = 'The {{ entity }} with {{ field }} "{{ value }}" does not exist.',
        public ?string $field = null,
        mixed $options = null,
        ?array $groups = null,
        mixed $payload = null,
    ) {
        if (!is_array($options)) {
            $options = [
                'entityClass' => $this->entityClass,
                'repositoryMethod' => $this->repositoryMethod,
                'message' => $this->message,
                'field' => $this->field,
            ];
        }
        parent::__construct($options, $groups, $payload);
    }

    public function getRequiredOptions(): array
    {
        return ['entityClass'];
    }
}
