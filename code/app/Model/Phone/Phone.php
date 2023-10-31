<?php

declare(strict_types=1);

namespace App\Model\Phone;

use Core\Model\Data\DataModelInterface;
use Core\Model\DataAbstractModel;

class Phone extends DataAbstractModel implements DataModelInterface
{
    public function __construct(
        private ?int $id = null,
        private ?int $user_id = null,
        private string $name = '',
        private string $surname = '',
        private string $phone = '',
        private string $email = '',
        private string $image_name = '',
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @inheritDoc
     */
    public function getData(): array
    {
        return [
            'id' => $this->getId(),
            'user_id' => $this->getUserId(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'phone' => $this->getPhone(),
            'email' => $this->getEmail(),
            'image_name' => $this->getImageName(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function setData(array $data): void
    {
        $this->setId($data['id']);
        $this->setUserId($data['user_id']);
        $this->setName($data['name']);
        $this->setSurname($data['surname']);
        $this->setPhone($data['phone']);
        $this->setEmail($data['email']);
        $this->setImageName($data['image_name']);
    }

    public function getImageName(): string
    {
        return $this->image_name;
    }

    public function setImageName(string $imageName): void
    {
        $this->image_name = $imageName;
    }
}