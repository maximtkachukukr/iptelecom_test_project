<?php

declare(strict_types=1);

namespace App\Service\User;

readonly class HashPassword
{
    /**
     * Hash password service
     *
     * @param string $password
     * @return string
     */
    public function execute(string $password): string
    {
        return password_hash($password, PASSWORD_ALGORITHM);
    }
}