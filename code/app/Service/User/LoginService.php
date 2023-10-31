<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Model\UserRepository;
use Core\Http\RequestInterface;
use Core\Http\Validation\Response\ResponseInterface;
use Core\SessionSingleton;
use Exception;

readonly class LoginService
{
    private UserRepository $userRepository;

    private SessionSingleton $session;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->session = SessionSingleton::getInstance();
    }

    /**
     * Login user from request data
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return bool
     */
    public function execute(RequestInterface $request, ResponseInterface $response): bool
    {
        try {
            $user = $this->userRepository->getByLogin($request->getParam('login'));
        } catch (Exception $e) {
            $response->setCustomErrorMessage('login', 'Such login doesn\'t exist');
            $response->setIsValid(false);
            return false;
        }

        if (password_verify($request->getParam('password'), $user->getPassword())) {
            $this->session->set(SessionSingleton::LOGGED_IN_USER_DATA_KEY, $user->getData());
            return true;
        } else {
            $response->setCustomErrorMessage('password', 'Password in wrong');
            $response->setIsValid(false);
        }
        return false;

    }
}