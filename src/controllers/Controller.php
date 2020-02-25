<?php
declare(strict_types=1);

namespace Juinsa\controllers;


use Juinsa\ViewManager;

abstract  class Controller
{

    protected ViewManager $viewManager;

    public function __construct(ViewManager $viewManager)
    {
        $this->viewManager = $viewManager;
    }

    public abstract function index();


}