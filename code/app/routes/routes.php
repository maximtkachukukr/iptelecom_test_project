<?php

declare(strict_types=1);

$router = Core\RouterSingleton::getInstance();
$router->addRoute('/', \App\Controller\Login::class);
$router->addRoute('/signup', \App\Controller\Signup::class);
$router->addRoute('/phonebook/list', \App\Controller\Phonebook\Index::class);
$router->addRoute('/phonebook/add-phonebook-item', \App\Controller\Phonebook\AddPhonebookItem::class);
$router->addRoute('/phonebook/delete-phonebook-item', \App\Controller\Phonebook\DeletePhonebookItem::class);
$router->addRoute('/phonebook/get-list', \App\Controller\Phonebook\GetList::class);