<?php


namespace Juinsa\Services;


use Juinsa\DoctrineManager;
use Juinsa\LogManager;

abstract class Service
{
    protected $doctrineManager;
    protected $logManagaer;

    public function __construct(DoctrineManager $doctrineManager, LogManager $logManagaer)
    {
        $this->doctrineManager = $doctrineManager;
        $this->logManagaer = $logManagaer;

        $this->logManagaer->info("Service ->".get_class($this)." up");
    }
}