<?php

declare(strict_types=1);

namespace Core\Http\Validation\Rule;

readonly class MaxLengthRule implements RuleInterface
{
    readonly private int $maxLength;
    public function __construct(array $params)
    {
        $this->maxLength = $params['maxLength'];
    }

    /**
     * @inheritDoc
     */
    public function isValid(mixed $value): bool
    {
        return is_string($value) && strlen($value) <= $this->maxLength;
    }

    /**
     * @inheritDoc
     */
    public function getDefaultErrorMessage(): string
    {
        return 'Max length is ' . $this->maxLength;
    }
}