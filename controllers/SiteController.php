<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{

    public  function home()
    {
        $params = [
            'name' => 'Ilya'
        ];
        // return Application::$app->router->renderView('home', $params);
        return $this->render('home', $params);
    }


    public  function contact()
    {
        // return Application::$app->router->renderView('contact');
        return $this->render('contact');
    }


    public static function handleContact()
    {
        return 'Handling submitted data';
    }
}
