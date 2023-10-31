<?php

declare(strict_types=1);

namespace Core\Http\Validation\Rule;

use Exception;
use finfo;

readonly class FileInExtListRule implements RuleInterface
{
    private array $mimeTypes;

    public function __construct(array $params)
    {
        $this->mimeTypes = $params['mimeTypes'];
    }

    /**
     * @inheritDoc
     */
    public function isValid(mixed $value): bool
    {
        if (is_array($value)) {
            return in_array($this->getFileMimeType($value), $this->mimeTypes, true);
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getDefaultErrorMessage(): string
    {
        return 'File extensions allowed: ' . implode(', ', $this->mimeTypes);
    }

    /**
     * Get tpm file extension
     *
     * @param array $file
     * @return string
     * @throws Exception
     */
    private function getFileMimeType(array $file): string
    {
        $fInfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $fInfo->file($file['tmp_name']);
        if ($mimeType !== false) {
            return $mimeType;
        }
        throw new Exception('get image mime type error');
    }
}