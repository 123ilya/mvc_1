<?php

require_once __DIR__ . '/vendor/autoload.php';


use app\core\Application;


$app = new Application();


$app->router->get('/mvc_1/', function () {
    return 'Home';
});

$app->router->get('/mvc_1/contact', function () {
    return 'Contact';
});


$app->run();
