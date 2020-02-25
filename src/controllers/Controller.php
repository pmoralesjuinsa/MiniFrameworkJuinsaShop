<?php
declare(strict_types=1);

namespace Juinsa\controllers;


use Juinsa\DoctrineManager;
use Juinsa\ViewManager;

abstract  class Controller
{

    protected ViewManager $viewManager;
    protected DoctrineManager $doctrineManager;

    public function __construct(ViewManager $viewManager, DoctrineManager $doctrineManager)
    {
        $this->viewManager = $viewManager;
        $this->doctrineManager = $doctrineManager;
    }

    public abstract function index();


}