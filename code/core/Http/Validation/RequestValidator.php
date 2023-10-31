<?php

declare(strict_types=1);

namespace Core\Http\Validation;

use Core\Http\RequestInterface;
use Core\Http\Validation\Response\ResponseFactory;
use Core\Http\Validation\Response\ResponseInterface;
use Core\Http\Validation\Rule\RuleFactory;
use Exception;

/**
 * Request validator
 */
abstract class RequestValidator
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MAX_LENGTH = 'max_length';
    public const WITH_LATIN_LETTERS_RULE = 'with_latin_letters_rule';
    public const WITH_NUMBERS_RULE = 'with_numbers_rule';
    public const DIFFERENT_LETTER_CASES_RULE = 'different_letter_cases_rule';
    public const RULE_MIN_LENGTH = 'min_length';
    public const RULE_UNIQUE = 'unique';
    public const RULE_FILE_MAX_SIZE = 'file_max_size';
    public const RULE_FILE_EXT_LIST = 'file_ext_list';

    private RuleFactory $ruleFactory;
    private ResponseFactory $responseFactory;
    public function __construct() {
        $this->ruleFactory = new RuleFactory();
        $this->responseFactory = new ResponseFactory();
    }

    /**
     * Validate request
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function validate(RequestInterface $request): ResponseInterface
    {
        // todo move to separated private functions because of big code nesting
        $isValid = true;
        $messages = [];
        foreach ($this->getRules() as $paramName => $ruleList) {
            foreach ($ruleList as $ruleType) {

                if (is_array($ruleType)) {
                    $rule = $this->ruleFactory->create($ruleType['rule'], $ruleType);
                    $ruleTypeName = $ruleType['rule'];
                } else {
                    $rule = $this->ruleFactory->create($ruleType);
                    $ruleTypeName = $ruleType;
                }

                if (!$rule->isValid($request->getParam($paramName))) {
                    $isValid = false;
                    $messages[$paramName][$ruleTypeName] = $this->getErrorMessage($paramName, $ruleTypeName)
                        ?? $rule->getDefaultErrorMessage();
                }
            }
        }

        return $this->responseFactory->create($isValid, $messages);
    }

    /**
     * Get error messages. Gets default messages if not specified here
     *
     * @return array
     */
    protected function getErrorMessages(): array
    {
        return [];
    }

    /**
     * Get validation rules. Example:
     * return [
     *   'login' => [self::RULE_REQUIRED]
     *  ]
     *
     * @return array
     */
    abstract public function getRules(): array;

    /**
     * Get error message by provided params
     *
     * @param string $paramName
     * @param string $ruleType
     * @return string|null
     */
    private function getErrorMessage(string $paramName, string $ruleType): ?string
    {
        return $this->getErrorMessages()[$paramName][$ruleType] ?? null;
    }
}