<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\User\IsLoggedIn;
use App\Service\User\LoginService;
use Core\Controller\ControllerInterface;
use Core\Http\Request;
use Core\Http\RequestInterface;
use App\Http\Validation\LoginFormValidator;

class Login implements ControllerInterface
{
    private LoginService $loginService;
    private IsLoggedIn $isLoggedIn;

    public function __construct()
    {
        $this->loginService = new LoginService();
        $this->isLoggedIn = new IsLoggedIn();
    }

    /**
     * @inheritDoc
     */
    public function execute(RequestInterface $request): void
    {
        if ($this->isLoggedIn->execute()) {
            header('Location: /phonebook/list');
        }

        /** @var Request $request */
        if ($request->isAjax() && $request->isPost()) {
            $this->processLoginRequest($request);
        } else {
            require_once VIEWS_PATH . '/login.php';
        }
    }

    private function processLoginRequest(RequestInterface $request): void
    {
        $validationResponse = (new LoginFormValidator())->validate($request);
        if ($validationResponse->isValid()
            && $this->loginService->execute($request, $validationResponse)) {
            echo json_encode([
                'isValid' => true,
                'redirect_to' => 'phonebook/list'
            ]);
        } else {
            echo $validationResponse->toJson();
        }
    }
}