<?php
declare(strict_types=1);

namespace Juinsa;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogManager
{
 private $logger;
 public function __construct()
 {
     $this->logger = new Logger("Juinsa");
     $this->logger->pushHandler(
         new StreamHandler(dirname(__DIR__).'/cache/logs/dev.log')
     );
 }

 public function info(String $message)
 {
     $this->logger->info($message);
 }
 public function warning(String $message)
 {
     $this->logger->warning($message);
 }
 public function  error(String $message)
 {
     $this->logger->error($message);
 }


}