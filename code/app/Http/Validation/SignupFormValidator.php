<?php

declare(strict_types=1);

namespace App\Http\Validation;

use Core\Http\Validation\RequestValidator;

class SignupFormValidator extends RequestValidator
{
    /**
     * @inheritDoc
     */
    public function getRules(): array
    {
        return [
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
                ['rule' => self::RULE_UNIQUE, 'column' => 'email', 'resourceModel' => \App\Model\User\ResourceModel\User::class]
            ],
            'login' => [
                self::RULE_REQUIRED,
                ['rule' => self::RULE_MAX_LENGTH, 'maxLength' => 16],
                self::WITH_LATIN_LETTERS_RULE,
                self::WITH_NUMBERS_RULE,
                ['rule' => self::RULE_UNIQUE, 'column' => 'login', 'resourceModel' => \App\Model\User\ResourceModel\User::class]
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
            // redeclare messages for password, email if needed
        ];
    }
}