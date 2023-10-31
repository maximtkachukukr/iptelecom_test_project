<?php

declare(strict_types=1);

namespace App\Http\Validation;

use Core\Http\Validation\RequestValidator;

class CreatePhoneFormValidator extends RequestValidator
{
    /**
     * @inheritDoc
     */
    public function getRules(): array
    {
        return [
            'name' => [
                self::RULE_REQUIRED
            ],
            'surname' => [
                self::RULE_REQUIRED
            ],
            'phone' => [
                self::RULE_REQUIRED,
            ],
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL
            ],
            'image' => [
                self::RULE_REQUIRED,
                ['rule' => self::RULE_FILE_MAX_SIZE, 'size' => 5],
                ['rule' => self::RULE_FILE_EXT_LIST, 'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png']]
            ]
        ];
    }
}