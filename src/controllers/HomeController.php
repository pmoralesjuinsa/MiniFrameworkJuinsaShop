<?php

declare(strict_types=1);
namespace Juinsa\controllers;


use DI\Annotation\Inject;
use Juinsa\ViewManager;

class HomeController extends Controller
{

   

    public function index()
    {
            $this->viewManager->renderTemplate("index.twig.html");
    }
}