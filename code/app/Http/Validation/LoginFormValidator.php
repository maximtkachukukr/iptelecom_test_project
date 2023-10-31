<?php

declare(strict_types=1);

namespace App\Http\Validation;

use Core\Http\Validation\RequestValidator;

class LoginFormValidator extends RequestValidator
{
    /**
     * @inheritDoc
     */
    public function getRules(): array
    {
        return [
            'login' => [
                self::RULE_REQUIRED,
                ['rule' => self::RULE_MAX_LENGTH, 'maxLength' => 16],
                self::WITH_LATIN_LETTERS_RULE,
                self::WITH_NUMBERS_RULE
            ],
            'password' => [
                self::RULE_REQUIRED,
                self::WITH_NUMBERS_RULE,
                self::DIFFERENT_LETTER_CASES_RULE,
                ['rule' => self::RULE_MIN_LENGTH, 'minLength' => 6]
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getErrorMessages(): array
    {
        return [
            'login' => [
                self::RULE_REQUIRED => 'Enter login please',
                self::RULE_EMAIL => 'Must be email address'
            ],
            // redeclare messages for password if needed
        ];
    }
}