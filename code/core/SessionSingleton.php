<?php

declare(strict_types=1);

namespace Core;

use Exception;

class SessionSingleton
{
    public const LOGGED_IN_USER_DATA_KEY = 'logged_in_user_data';
    private static self|null $instance = null;

    protected function __construct()
    {
        $isStared = session_start();
        if ($isStared === false) {
            throw new Exception('Session isn\'t configured');
        }
    }

    /**
     * Method for setting property and value to current session.
     *
     * @param string $propertyName
     * @param mixed $propertyValue
     *
     * @return void
     */
    public function set(string $propertyName, mixed $propertyValue): void
    {
        $_SESSION[$propertyName] = $propertyValue;
    }

    /**
     * Method for getting property value from current session.
     *
     * It will return all values if $propertyName is set to null, but if property
     * defined but does not exist it will return null.
     *
     * @param string|null $propertyName
     *
     * @return mixed
     */
    public function get(string $propertyName = null): mixed
    {

        if ($propertyName === null) {
            return $_SESSION;
        }

        if (array_key_exists($propertyName, $_SESSION)) {
            return $_SESSION[$propertyName];
        }

        return null;
    }

    final protected function __clone(){}

    final public function __wakeup()
    {
        throw new Exception('not implemented method');
    }

    public static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = new self();
        }

        return static::$instance;
    }
}