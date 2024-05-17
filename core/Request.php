<?php

namespace app\core;
class Request
{
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function getUri(){
        return $_SERVER['REQUEST_URI'];
    }
    public function getUriExploded(): array
    {
        return explode('/',$_SERVER['REQUEST_URI']);
    }

}