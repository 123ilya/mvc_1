<?php

require_once __DIR__ . '/../vendor/autoload.php';


use app\core\Application;


$app = new Application();


$app->router->get('/mvc_1/public/', function () {
    return 'Home';
});

$app->router->get('/mvc_1/public/contact', 'contact');


$app->run();
