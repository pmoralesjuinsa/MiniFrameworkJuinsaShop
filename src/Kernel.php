<?php
declare (strict_types=1);

namespace Juinsa;

use DI\Container;
use DI\ContainerBuilder;

class Kernel
{

   protected $logger;
   protected $container;

   public function __construct()
   {
     $this->container = $this->createContainer();
     $this->logger = $this->container->get(LogManager::class);
   }

   public function init(){
       $this->logger->info("Iniciamos el Server");
   }



   public function createContainer():Container{
       $containerBuilder = new ContainerBuilder();
       $containerBuilder->useAutowiring(true);
       return $containerBuilder->build();

   }


}