<?php

declare(strict_types=1);

namespace Core\Http\Validation\Rule;

use Exception;

readonly class FileMaxSizeRule implements RuleInterface
{
    private int $size;

    public function __construct(array $params)
    {
        $this->size = (int)$params['size'];
    }

    /**
     * @inheritDoc
     */
    public function isValid(mixed $value): bool
    {
        if (is_array($value)) {
            $fileSize = filesize($value['tmp_name']);
            if ($fileSize === false) {
                throw new Exception('can\'t get file size');
            }
            $sizeInMb = $fileSize / 1024 / 1024;
            return $sizeInMb < $this->size;
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getDefaultErrorMessage(): string
    {
        return 'File mist be less then ' . $this->size . 'MB';
    }
}