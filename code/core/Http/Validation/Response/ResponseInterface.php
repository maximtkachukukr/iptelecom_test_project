<?php

declare(strict_types=1);

namespace Core\Http\Validation\Response;

interface ResponseInterface
{
    /**
     * Is validation success
     *
     * @return bool
     */
    public function isValid(): bool;

    /**
     * Set is valid value
     *
     * @param bool $isValid
     * @return void
     */
    public function setIsValid(bool $isValid): void;

    /**
     * Add custom error message
     *
     * @param string $field
     * @param string $message
     * @return void
     */
    public function setCustomErrorMessage(string $field, string $message): void;

    /**
     * Get error messages if not valid. Return array otherwise
     *
     * @param bool $firstsOnly - returns only one message if true, all messages otherwise
     * @return array
     */
    public function getErrorMessages(bool $firstsOnly = false): array;

    /**
     * Format to json
     *
     * @return string
     */
    public function toJson(): string;
}