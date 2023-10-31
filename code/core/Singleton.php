<?php

declare(strict_types=1);

namespace Core;

use Exception;

/**
 * Singleton implementation
 */
abstract class Singleton
{
    protected static self|null $instance = null;

    protected function __construct(){}

    final protected function __clone(){}

    final public function __wakeup()
    {
        throw new Exception('not implemented method');
    }

    public static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = static::getNewInstance();
        }

        return static::$instance;
    }

    /**
     * Get new instance
     *
     * @return static
     */
    protected static function getNewInstance(): static
    {
        return new static();
    }
}