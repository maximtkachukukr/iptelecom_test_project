<?php

declare(strict_types=1);

namespace Core\Http\Validation\Rule;

use Core\Http\Validation\RequestValidator;
use Exception;

/**
 * todo add instances caching here
 */
class RuleFactory
{
    /**
     * @var array|string[]
     */
    private array $instances = VALIDATION_RULE_TYPES;

    /**
     * Create new rule based on rule type string
     *
     * @param string $rule
     * @param array $params
     * @return RuleInterface
     * @throws Exception
     */
    public function create(string $rule, array $params = []): RuleInterface
    {
        if (array_key_exists($rule, $this->instances)) {
            return new $this->instances[$rule]($params);
        }

        throw new Exception($rule . ' rule does not exist');
    }
}