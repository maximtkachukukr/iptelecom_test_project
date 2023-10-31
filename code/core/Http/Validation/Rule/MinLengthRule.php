<?php

declare(strict_types=1);

namespace Core\Http\Validation\Rule;

readonly class MinLengthRule implements RuleInterface
{
    readonly private int $minLength;
    public function __construct(array $params)
    {
        $this->minLength = $params['minLength'];
    }

    /**
     * @inheritDoc
     */
    public function isValid(mixed $value): bool
    {
        return is_string($value) && strlen($value) >= $this->minLength;
    }

    /**
     * @inheritDoc
     */
    public function getDefaultErrorMessage(): string
    {
        return 'Min length is ' . $this->minLength;
    }
}