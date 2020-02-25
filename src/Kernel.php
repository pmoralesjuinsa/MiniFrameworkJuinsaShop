<?php
declare (strict_types=1);

namespace Juinsa;

use DI\Container;
use DI\ContainerBuilder;
use Juinsa\routing\Web;
use Kint;

class Kernel
{

    protected $logger;
    protected $container;

    public function __construct()
    {
        $this->container = $this->createContainer();
        $this->logger = $this->container->get(LogManager::class);
    }

    public function init()
    {
        $this->logger->info("Iniciamos el Server");
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routeManager = $this->container->get(RouterManager::class);
        $routeManager->dispatch($httpMethod, $uri, Web::getDispatcher());
    }


    public function createContainer(): Container
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->useAutowiring(true);

        return $containerBuilder->build();
    }


}