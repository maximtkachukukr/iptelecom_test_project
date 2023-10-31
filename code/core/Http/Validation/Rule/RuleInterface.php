<?php

declare(strict_types=1);

namespace Core\Http\Validation\Rule;

use Exception;

interface RuleInterface
{
    /**
     * Is rule valid
     *
     * @param string|null $value
     * @return bool
     * @throws Exception//todo create custom exception
     */
    public function isValid(mixed $value): bool;

    /**
     * Get default validation error message
     *
     * @return string
     */
    public function getDefaultErrorMessage(): string;
}