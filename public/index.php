<?php

use EneraTechTest\Infrastructure\Slim\AppFactory;

require_once '../vendor/autoload.php';

session_start();

$app = AppFactory::app();

$app->run();
