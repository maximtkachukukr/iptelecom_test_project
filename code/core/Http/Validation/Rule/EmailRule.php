<?php

declare(strict_types=1);

namespace Core\Http\Validation\Rule;

readonly class EmailRule implements RuleInterface
{

    /**
     * @inheritDoc
     */
    public function isValid(mixed $value): bool
    {
        return (bool)filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultErrorMessage(): string
    {
        return 'Value must be email';
    }
}