<?php

namespace app\controllers;

use app\core\Application;

class SiteController
{



    public static function contact()
    {
        return Application::$app->router->renderView('contact');
    }


    public static function handleContact()
    {
        return 'Handling submitted data';
    }
}
