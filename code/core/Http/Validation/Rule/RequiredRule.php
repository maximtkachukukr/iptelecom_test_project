<?php

declare(strict_types=1);

namespace Core\Http\Validation\Rule;

readonly class RequiredRule implements RuleInterface
{
    /**
     * @inheritDoc
     */
    public function isValid(mixed $value): bool
    {
        return /*for text*/(is_string($value) && strlen($value) > 0) || /*for files*/is_array($value);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultErrorMessage(): string
    {
        return 'This field is required';
    }
}