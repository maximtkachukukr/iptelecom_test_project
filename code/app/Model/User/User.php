<?php

declare(strict_types=1);

namespace App\Model\User;

use Core\Model\Data\DataModelInterface;
use Core\Model\DataAbstractModel;

class User extends DataAbstractModel implements DataModelInterface
{
    public function __construct(
        private ?int $id = null,
        private string $email = '',
        private string $login = '',
        private string $password = ''
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function getData(): array
    {
        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'login' => $this->getLogin(),
            'password' => $this->getPassword()
        ];
    }

    /**
     * @inheritDoc
     */
    public function setData(array $data): void
    {
        $this->setId($data['id']);
        $this->setEmail($data['email']);
        $this->setLogin($data['login']);
        $this->setPassword($data['password']);
    }
}