<?php

declare(strict_types=1);

namespace App\Service\User;

use Core\SessionSingleton;

readonly class IsLoggedIn
{
    private SessionSingleton $session;

    public function __construct()
    {
        $this->session = SessionSingleton::getInstance();
    }

    public function execute(): bool
    {
        $userData = $this->session->get(SessionSingleton::LOGGED_IN_USER_DATA_KEY);
        return is_array($userData) && isset($userData['id']);
    }
}