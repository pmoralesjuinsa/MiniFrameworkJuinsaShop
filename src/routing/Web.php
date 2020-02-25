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
            }
        );
    }
}