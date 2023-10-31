<?php

declare(strict_types=1);

namespace Core\Http\Validation\Rule;

readonly class DifferentLetterCasesRule implements RuleInterface
{

    /**
     * @inheritDoc
     */
    public function isValid(mixed $value): bool
    {
        return is_string($value)
            && strlen($value) > 0
            && (bool)preg_match("/[a-z]/", $value)
            && (bool)preg_match("/[A-Z]/", $value);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultErrorMessage(): string
    {
        return 'Must have different letter cases';
    }
}