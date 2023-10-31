<?php

declare(strict_types=1);

namespace App\Controller\Phonebook;

use App\Http\Validation\CreatePhoneFormValidator;
use App\Model\Phone\ImageUploader;
use App\Model\Phone\Phone;
use App\Model\Phone\PhoneFactory;
use App\Model\PhoneRepository;
use App\Service\User\IsLoggedIn;
use Core\Controller\ControllerInterface;
use Core\Http\RequestInterface;
use Core\SessionSingleton;
use Exception;

class AddPhonebookItem implements ControllerInterface
{
    private PhoneFactory $phoneFactory;
    private SessionSingleton $session;
    private PhoneRepository $phoneRepository;
    private IsLoggedIn $isLoggedIn;
    private ImageUploader $imageUploader;

    public function __construct()
    {
        $this->phoneFactory = new PhoneFactory();
        $this->phoneRepository = new PhoneRepository();
        $this->session = SessionSingleton::getInstance();
        $this->isLoggedIn = new IsLoggedIn();
        $this->imageUploader = new ImageUploader();
    }

    /**
     * @inheritDoc
     */
    public function execute(RequestInterface $request): void
    {
        if (!$request->isAjax() || !$request->isPost() || !$this->isLoggedIn->execute()) {
            exit(); //todo add redirect somewhere
        }

        $response = (new CreatePhoneFormValidator())->validate($request);
        if ($response->isValid()) {
            $phoneModel = $this->getPhoneModel($request);
            try {
                /** @var null|array $imageTmp */
                $imageTmp = $request->getParam('image');
                if ($imageTmp !== null) {
                    $this->imageUploader->upload($phoneModel, $imageTmp['tmp_name']);
                }
                $this->phoneRepository->save($phoneModel);
            } catch (Exception $e) {
                $response->setIsValid(false);
                $this->imageUploader->remove($phoneModel);// try to remove image if save to DB error
                // todo send to client any message make him to understand wat has happened
            }
        }
        echo $response->toJson();
    }

    /**
     * Create new model from request
     *
     * @param RequestInterface $request
     * @return Phone
     */
    public function getPhoneModel(RequestInterface $request): Phone
    {
        $phoneModel = $this->phoneFactory->create();
        $phoneModel->setUserId($this->session->get(SessionSingleton::LOGGED_IN_USER_DATA_KEY)['id']);
        $phoneModel->setName($request->getParam('name'));
        $phoneModel->setSurname($request->getParam('surname'));
        $phoneModel->setPhone($request->getParam('phone'));
        $phoneModel->setEmail($request->getParam('email'));
        return $phoneModel;
    }
}