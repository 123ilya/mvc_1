<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\SiteController;
use app\core\Application;


$app = new Application(dirname(__DIR__));
// echo dirname(__DIR__);
// exit;


$app->router->get('/mvc_1/public/', 'home');
$app->router->get('/mvc_1/public/contact', [SiteController::class, 'contact']);
$app->router->post('/mvc_1/public/contact', [SiteController::class, 'handleContact']);



$app->run();
