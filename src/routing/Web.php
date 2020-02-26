<?php


namespace Juinsa\routing;


use FastRoute\Dispatcher;

class Web
{
    public static function getDispatcher():Dispatcher{
        return \FastRoute\simpleDispatcher(
            function (\Fastroute\RouteCollector $route){
                $route->addRoute('GET','/',['Juinsa\controllers\HomeController','index']);
                $route->addRoute('GET','/who',['Juinsa\controllers\WhoController','index']);
                $route->addRoute('GET','/register',['Juinsa\controllers\Auth\RegisterController','index']);
                $route->addRoute('POST','/register',['Juinsa\controllers\Auth\RegisterController','register']);
                $route->addRoute('GET','/login',['Juinsa\controllers\Auth\LoginController','index']);
                $route->addRoute('POST','/login',['Juinsa\controllers\Auth\LoginController','login']);
                $route->addRoute('GET','/logout',['Juinsa\controllers\Auth\LoginController','logout']);
            }
        );
    }
}