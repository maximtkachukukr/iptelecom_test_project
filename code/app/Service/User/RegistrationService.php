<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Model\User\UserFactory;
use App\Model\UserRepository;
use Core\Http\RequestInterface;
use Exception;

readonly class RegistrationService
{
    private UserFactory $userFactory;
    private UserRepository $userRepository;
    private HashPassword $hashPassword;

    public function __construct()
    {
        $this->userFactory = new UserFactory();
        $this->userRepository = new UserRepository();
        $this->hashPassword = new HashPassword();
    }

    /**
     * Create new user from request
     *
     * @param RequestInterface $request
     * @return true|string - true or error message
     */
    public function execute(RequestInterface $request): true|string
    {
        $user = $this->userFactory->create([
            'login' => $request->getParam('login'),
            'email' => $request->getParam('email'),
            'password' => $this->hashPassword->execute($request->getParam('login'))
        ]);
        try {
            $this->userRepository->save($user);
        } catch (Exception $e) {
            return 'Save error. Try again later';
        }

        return true;
    }
}