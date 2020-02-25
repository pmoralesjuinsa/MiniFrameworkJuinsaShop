<?php


namespace Juinsa;


use DI\Container;

class RouterManager
{
    private $container;

    public function __construct( Container $container)
    {
        $this->container =$container;
    }


    public function dispatch(string $requestMethod, string $requestUri, \FastRoute\Dispatcher $dispatcher)
    {
        $route = $dispatcher->dispatch($requestMethod, $requestUri);
        switch($route[0])
        {
            case \FastRoute\Dispatcher::NOT_FOUND:
            header("HTTP/1.0 404 NotFound");
            echo "<h1>NOT FOUND </h1>";
            break;
            case \FastRoute\Dispatcher::FOUND:
                $controller = $route[1];
                $action = $route[2];
                $this->container->call($controller, $action);
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                header("HTTP/10 405 Method not Allowed");
                echo "<h1>Method Not Allowed</h1>";
                break;

        }

    }
}