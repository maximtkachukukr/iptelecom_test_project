<?php

declare(strict_types=1);

error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once '../app/routes/routes.php';

$router = Core\RouterSingleton::getInstance();
$router->execute();