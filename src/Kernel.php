<?php
declare (strict_types=1);

namespace Juinsa;

use DI\Container;
use DI\ContainerBuilder;
use Juinsa\routing\Web;
use Symfony\Component\HttpFoundation\Session\Session;

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
        $session = new Session();
        $session->start();

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
        $containerBuilder->useAnnotations(true);

        return $containerBuilder->build();
    }


}