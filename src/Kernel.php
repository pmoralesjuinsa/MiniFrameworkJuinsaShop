<?php
declare (strict_types=1);

namespace Juinsa;

class Kernel
{

   protected $logManager;
   protected $viewManager;

   public function __construct()
   {
       $this->logManager = new LogManager();
       $this->logManager->info("Start Project Juinsa");
       $this->viewManager = new ViewManager();
       $this->viewManager->renderTemplate("index.twig.html");

   }


}