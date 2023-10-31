<?php

declare(strict_types=1);

namespace Core\Http\Validation\Response;

class Response implements ResponseInterface
{
    public function __construct(private bool $isValid, private array $errorMessages = [])
    {
    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @inheritDoc
     */
    public function setCustomErrorMessage(string $field, string $message): void
    {
        $this->errorMessages[$field]['custom'] = $message;
    }

    /**
     * @inheritDoc
     */
    public function getErrorMessages(bool $firstsOnly = false): array
    {
        return array_map(
            fn(array $messages) => $firstsOnly ? $messages[array_key_first($messages)] : $messages,
            $this->errorMessages
        );
    }

    /**
     * Format response to json
     * @return string
     */
    public function toJson(): string
    {
        return json_encode([
            'isValid' => $this->isValid(),
            'errorMessages' => $this->getErrorMessages()
        ]);
    }

    public function setIsValid(bool $isValid): void
    {
        $this->isValid = $isValid;
    }
}