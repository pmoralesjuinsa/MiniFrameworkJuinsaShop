<?php
declare (strict_types=1);

namespace Juinsa;

class Kernel
{

   protected $logManager;

   public function __construct()
   {
       $this->logManager = new LogManager();
       $this->logManager->info("Start Project Juinsa");
   }


}