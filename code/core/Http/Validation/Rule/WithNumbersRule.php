<?php

declare(strict_types=1);

namespace Core\Http\Validation\Rule;

readonly class WithNumbersRule implements RuleInterface
{
    /**
     * @inheritDoc
     */
    public function isValid(mixed $value): bool
    {
        return is_string($value) && strlen($value) > 0 && (bool)preg_match("/[0-9]/i", $value);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultErrorMessage(): string
    {
        return 'Must have numbers';
    }
}