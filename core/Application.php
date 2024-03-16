<?php

namespace app\core;

class Application
{
    public static string $ROOT_DIR; //Константа, соответсвующая дирректории проекта
    public Router $router; //Экземпляр класса Router
    public Request $request; //Экземпляр класса Request
    public Response $response; //Экземпляр класса Response
    public static Application $app; //Экземпляр текущего класса. Статическое свойство.
    public Controller $controller; //Экземпляр класса Controller

    //В качестве аргумента принимаем дирректорию проекта
    public function __construct($rootPath)
    {
        self::$app = $this; //Не понимаюя, что здесь происходит
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request; //Инициализируем свойство request
        $this->response = new Response; //Инициализируем свойство response
        $this->router = new Router($this->request, $this->response); //Инициализируем свойство $router
    }
    //---------------------------------------------------------------------------------------------
    // Выводим результат вызова метода resolve(), экземпляра класса Router
    public function run()
    {
        echo $this->router->resolve();
    }
    //----------------------------------------------------------------------------------------------
    //Возвращаем экземпляр подкласса класса Controller(AuthoController или SiteController например)
    public function getController(): Controller
    {
        return $this->controller;
    }
    //-----------------------------------------------------------------------------------------
    // Записываем в свойство $controller экземпляр подкласса класса Controller(AuthoController или SiteController например)
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}
