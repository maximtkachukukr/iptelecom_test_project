<?php

declare(strict_types=1);

namespace App\Model\User;

class UserFactory
{
    public function create(array $dataParams = []): User
    {
        return new User(...$dataParams);
    }
}