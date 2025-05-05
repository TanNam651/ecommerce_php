<?php
namespace Core;
class Router
{
    private static array $routers = [];
    private function addRoute($method, $uri, $controller): void
    {   $route = $uri;
        self::$routers[] = [
            "route"=>$route,
            "controller"=>$controller,
            "method"=>$method
        ];
//        $this->routers[] = [
//            "route"=>$route,
//            "controller"=>$controller,
//            "method"=>$method
//        ];

    }

    public function get($uri, $controller): void
    {
        $this->addRoute('GET',$uri,$controller);
    }

    public function post($uri, $controller) :void
    {
        $this->addRoute('POST',$uri,$controller);
    }

    public function patch($uri, $controller):void
    {
        $this->addRoute('PATCH', $uri, $controller);
    }

    public function delete($uri, $controller):void
    {
        $this->addRoute('DELETE', $uri, $controller);
    }

    public function put($uri, $controller):void
    {
        $this->addRoute('PUT', $uri, $controller);
    }

    function dispatch($uri)
    {

        foreach (self::$routers as $route) {

            if($route['route'] == $uri ) {
                return require basePath("controllers/".$route['controller']);
            }

//            $routeRegex = preg_replace_callback('/{\w+(:([^}]+))?}/', function ($matches){
//                return isset($matches[1])?'('.$matches[2].')':'([a-zA-Z0-9_-]+)';
//            },$route);
//    echo json_encode($controller,JSON_UNESCAPED_UNICODE);
////            $routeRegex = '@'.$routeRegex.'@';
//            echo json_encode($routeRegex);
        }

    self::abort();
        return 0;
    }

    public function abort($code = 404):void
    {
        http_response_code($code);
         require "views/404.php";

         exit();
    }
}