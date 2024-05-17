<?php

namespace app\api;
use app\core\Request;
use app\core\Router;

class Api
{
    private static Api $api;
    public array $resourseList = [];
    public Router $router;
    private Request $request;

    public function __construct()
    {
        self::$api=$this;
        $this->request = new Request();
        $this->router = new Router(self::$api,$this->request);
    }

    public function registerResourse(string $name,$nameOfClass,array $methods = ['get']): void
    {
        $this->resourseList[] = ['name'=>$name,'nameOfClass'=>$nameOfClass,'methods'=>$methods];
    }

    public function run(): void
    {
        $this->router->resolve();
    }
}