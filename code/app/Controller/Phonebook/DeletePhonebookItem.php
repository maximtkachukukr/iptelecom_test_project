<?php

declare(strict_types=1);

namespace App\Controller\Phonebook;

use App\Model\PhoneRepository;
use App\Service\User\IsLoggedIn;
use Core\Controller\ControllerInterface;
use Core\Http\RequestInterface;

class DeletePhonebookItem implements ControllerInterface
{
    private PhoneRepository $phoneRepository;
    private readonly IsLoggedIn $isLoggedIn;

    public function __construct()
    {
        $this->phoneRepository = new PhoneRepository();
        $this->isLoggedIn = new IsLoggedIn();
    }

    /**
     * @inheritDoc
     */
    public function execute(RequestInterface $request): void
    {
        if (!$request->isAjax() || !$request->isPost() || !$this->isLoggedIn->execute()) {
            exit(); //todo add redirect somewhere
        }

        // todo add checking that this current user's
        $id = $request->getParam('id');
        $this->phoneRepository->deleteById((int)$id);

        echo json_encode(['is_success' => true]);
    }
}