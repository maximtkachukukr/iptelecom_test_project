<?php

declare(strict_types=1);

namespace App\Controller\Phonebook;

use App\Model\PhoneRepository;
use App\Service\User\IsLoggedIn;
use Core\Controller\ControllerInterface;
use Core\Http\RequestInterface;
use Core\SessionSingleton;

class GetList implements ControllerInterface
{
    private PhoneRepository $phoneRepository;
    private SessionSingleton $session;
    private IsLoggedIn $isLoggedIn;

    public function __construct()
    {
        $this->phoneRepository = new PhoneRepository();
        $this->session = SessionSingleton::getInstance();
        $this->isLoggedIn = new IsLoggedIn();
    }

    public function execute(RequestInterface $request): void
    {
        if (!$request->isAjax()) {
            exit();
        }

        if (!$this->isLoggedIn->execute()) {
            header('Location: /');
        }

        $res = $this->phoneRepository->getUserList(
            $this->session->get(SessionSingleton::LOGGED_IN_USER_DATA_KEY)['id'],
            ['id', 'DESC']
        );
        echo json_encode($res);
    }
}