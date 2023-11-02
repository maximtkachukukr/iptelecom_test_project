<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Phone\Phone;
use App\Model\Phone\PhoneFactory;
use App\Model\Phone\ResourceModel\Phone as PhoneResourceModel;
use Exception;

/**
 * todo Extract interface
 */
readonly class PhoneRepository
{
    private PhoneResourceModel $resourceModel;
    private PhoneFactory $phoneFactory;

    public function __construct()
    {
        $this->resourceModel = new PhoneResourceModel();
        $this->phoneFactory = new PhoneFactory();
    }

    public function getUserList(int $userId, array $ordering): array
    {
        /**
         * todo here have to be collection class, but I'm reeeealy tired.. :)
         * this function must return collection of dataModel
         */
        return $this->resourceModel->getAllByFilters(['user_id' => $userId], $ordering);
    }

    /**
     * @param int $id
     * @return Phone
     * @throws Exception
     */
    public function getById(int $id): Phone
    {
        $phone = $this->phoneFactory->create();
        $this->resourceModel->loadDataModel($phone, 'id', $id);
        if (!$phone->getId()) {
            throw new Exception('Not found');
        }
        return $phone;
    }

    /**
     * Delete phone by id
     * todo throw exception if delete error
     *
     * @param int $id
     * @return void
     */
    public function deleteById(int $id): void
    {
        $this->resourceModel->deleteByColumn('id', $id);
    }

    /**
     * Save phone to DB
     *
     * @param Phone $phone
     * @return void
     * @throws \Exception
     */
    public function save(Phone $phone): void
    {
        if ($phone->getId() === null) {
            $this->resourceModel->insert($phone);
        } else {
            //todo update to DB
        }
    }
}