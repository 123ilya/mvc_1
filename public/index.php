<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;


$app = new Application(dirname(__DIR__));



$app->router->get('/mvc_1/public/', [SiteController::class, 'home']);
$app->router->get('/mvc_1/public/contact', [SiteController::class, 'contact']);
$app->router->post('/mvc_1/public/contact', [SiteController::class, 'handleContact']);
$app->router->get('/mvc_1/public/login', [AuthController::class, 'login']);
$app->router->post('/mvc_1/public/login', [AuthController::class, 'login']);
$app->router->get('/mvc_1/public/register', [AuthController::class, 'register']);
$app->router->post('/mvc_1/public/register', [AuthController::class, 'register']);






$app->run();
