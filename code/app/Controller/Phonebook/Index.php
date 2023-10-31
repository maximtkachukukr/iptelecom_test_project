<?php

declare(strict_types=1);

namespace App\Controller\Phonebook;

use App\Service\User\IsLoggedIn;
use Core\Controller\ControllerInterface;
use Core\Http\RequestInterface;

class Index implements ControllerInterface
{
    private readonly IsLoggedIn $isLoggedIn;

    public function __construct()
    {
        $this->isLoggedIn = new IsLoggedIn();
    }

    /**
     * @inheritDoc
     */
    public function execute(RequestInterface $request): void
    {
        if (!$this->isLoggedIn->execute()) {
            header('Location: /');
        }

        require_once VIEWS_PATH . '/phonebook.php';
    }
}