<?php

declare(strict_types=1);

use Core\Http\Validation\RequestValidator;

define('APP_ROOT_PATH', dirname(__DIR__));
define('ROOT_PATH', dirname(dirname(__DIR__)));
const VIEWS_PATH = APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'views';
const PUBLIC_PATH = ROOT_PATH . DIRECTORY_SEPARATOR . 'public';
const PASSWORD_ALGORITHM = PASSWORD_DEFAULT;
const VALIDATION_RULE_TYPES = [//todo move it to core config, not app
    RequestValidator::RULE_REQUIRED => Core\Http\Validation\Rule\RequiredRule::class,
    RequestValidator::RULE_EMAIL => Core\Http\Validation\Rule\EmailRule::class,
    RequestValidator::RULE_MAX_LENGTH => Core\Http\Validation\Rule\MaxLengthRule::class,
    RequestValidator::WITH_LATIN_LETTERS_RULE => Core\Http\Validation\Rule\WithLatinLettersRule::class,
    RequestValidator::WITH_NUMBERS_RULE => Core\Http\Validation\Rule\WithNumbersRule::class,
    RequestValidator::DIFFERENT_LETTER_CASES_RULE => Core\Http\Validation\Rule\DifferentLetterCasesRule::class,
    RequestValidator::RULE_MIN_LENGTH => Core\Http\Validation\Rule\MinLengthRule::class,
    RequestValidator::RULE_UNIQUE => Core\Http\Validation\Rule\UniqueRule::class,
    RequestValidator::RULE_FILE_MAX_SIZE => Core\Http\Validation\Rule\FileMaxSizeRule::class,
    RequestValidator::RULE_FILE_EXT_LIST => Core\Http\Validation\Rule\FileInExtListRule::class,
];

const MARIADB_HOST = 'mariadb';
const MARIADB_DATABASE = 'app_db';
const MARIADB_USER = 'user';
const MARIADB_PASSWORD = 'password';

const PHONE_IMAGES_FOLDER = 'phone_images';