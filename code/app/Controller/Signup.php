<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\Validation\SignupFormValidator;
use App\Service\User\IsLoggedIn;
use App\Service\User\RegistrationService;
use Core\Controller\ControllerInterface;
use Core\Http\RequestInterface;

class Signup implements ControllerInterface
{
    private readonly RegistrationService $userRegistrationService;
    private IsLoggedIn $isLoggedIn;

    public function __construct()
    {
        $this->userRegistrationService = new RegistrationService();
        $this->isLoggedIn = new IsLoggedIn();
    }

    public function execute(RequestInterface $request): void
    {
        if ($this->isLoggedIn->execute()) {
            header('Location: /phonebook/list');
        }

        //vars for view start
        $validationErrorMessages = [];
        $postParams = [];
        $isSignedUp = false;
        $errorMessage = null;
        //vars for view end

        if ($request->isPost()) {
            $validationResponse = (new SignupFormValidator())->validate($request);
            if ($validationResponse->isValid()) {
                $result = $this->userRegistrationService->execute($request);
                $errorMessage = $result === true ? null : $result;
                $isSignedUp = $result === true;

            }
            $validationErrorMessages = $validationResponse->getErrorMessages(true);
            $postParams = $request->getParams();
        }
        require_once VIEWS_PATH . '/signup.php';
    }
}