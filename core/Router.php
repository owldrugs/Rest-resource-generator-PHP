<?php

namespace app\core;

use app\api\Api;

class Router
{
    private array $routes = [];
    public Api $apiMain;
    private Request $request;
    public function __construct(Api $api,Request $request)
    {
        $this->request=$request;
        $this->apiMain=$api;
    }

    public function generateApiRoutes(): void
    {
        foreach ($this->apiMain->resourseList as $route){
            $name = strtolower($route['name']);
            foreach ($route['methods'] as $method){
                if ($method=='get'){
                    $this->routes[$name]["$method"]["/$name"] = [$route['nameOfClass'],"$method".'All'];
                    $this->routes[$name]["$method"]["/$name/{id}"] = [$route['nameOfClass'],"$method"];
                }elseif($method=='post'){
                    $this->routes[$name]["$method"]["/$name"] = [$route['nameOfClass'],"$method"];
                }
                else{
                    $this->routes[$name]["$method"]["/$name/{id}"] = [$route['nameOfClass'],"$method"];
                }
            }
        }

    }

    public function resolve(): void
    {
        $this->generateApiRoutes();

        $method = $this->request->getMethod();
        $uriExploded = $this->request->getUriExploded();
        $uriResolve = $this->uriResolve($uriExploded);
        $id = $uriExploded[2]??false;
        if (isset($this->routes[$uriExploded[1]][$method][$uriResolve])){
            $this->routes[$uriExploded[1]][$method][$uriResolve][0] = new $this->routes[$uriExploded[1]][$method][$uriResolve][0]();
            header('Content-Type: application/json; charset=utf-8');
            if ($id){
                call_user_func($this->routes[$uriExploded[1]][$method][$uriResolve],$id);
            }
            else{
                call_user_func($this->routes[$uriExploded[1]][$method][$uriResolve]);
            }

        }
        else{
            http_response_code(	404);
            exit();
        }
    }

    private function uriResolve($uriExploded): bool|string
    {
        $uriResolve = [];
        if (count($uriExploded)>1){
            foreach ($uriExploded as $elem){
                if (preg_match('/^[0-9]+$/', $elem)) {
                    $uriResolve[]='{id}';
                }
                else{
                    $uriResolve[]=$elem;
                }
            }
            return implode('/',$uriResolve);
        }
        return false;
    }
}