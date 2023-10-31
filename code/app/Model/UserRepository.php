<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\User\ResourceModel\User as UserResourceModel;
use App\Model\User\User;
use App\Model\User\UserFactory;
use Exception;

/**
 * todo Extract interface
 */
readonly class UserRepository
{
    private UserResourceModel $resourceModel;
    private UserFactory $userFactory;

    public function __construct()
    {
        $this->resourceModel = new UserResourceModel();
        $this->userFactory = new UserFactory();
    }

    /**
     * Get user by login
     *
     * @param string $login
     * @return User
     * @throws Exception if not found
     */
    public function getByLogin(string $login): User
    {
        $user = $this->userFactory->create();
        $this->resourceModel->loadDataModel($user, 'login', $login);
        if ($user->getId() === null) {
            throw new Exception('User not found');
        }
        return $user;
    }

    /**
     * Save user to DB
     *
     * @param User $user
     * @return void
     * @throws Exception
     */
    public function save(User $user): void
    {
        if ($user->getId() === null) {
            $this->resourceModel->insert($user);
        } else {
            //todo update to DB
        }
    }
}