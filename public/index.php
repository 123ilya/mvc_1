<?php

require_once __DIR__ . '/../vendor/autoload.php';


use app\core\Application;


$app = new Application(dirname(__DIR__));


$app->router->get('/mvc_1/public/', 'home');

$app->router->get('/mvc_1/public/contact', 'contact');


$app->run();
