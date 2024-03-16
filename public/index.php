<?php
//Подключаем автозагрузчик композера
require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;

//Создаём экземпляр класса Application, в качестве аргумента принимаем дирректорию нашего приложения
$app = new Application(dirname(__DIR__));

//Регистрируем валидные запросы и соотвествующие им методы, а так же контроллеры и их методы, которые
//будут эти запросы обрабатывать.
$app->router->get('/mvc_1/public/', [SiteController::class, 'home']);
$app->router->get('/mvc_1/public/contact', [SiteController::class, 'contact']);
$app->router->post('/mvc_1/public/contact', [SiteController::class, 'handleContact']);
$app->router->get('/mvc_1/public/login', [AuthController::class, 'login']);
$app->router->post('/mvc_1/public/login', [AuthController::class, 'login']);
$app->router->get('/mvc_1/public/register', [AuthController::class, 'register']);
$app->router->post('/mvc_1/public/register', [AuthController::class, 'register']);


//Запускаем приложение
$app->run();
