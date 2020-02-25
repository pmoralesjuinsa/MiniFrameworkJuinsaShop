<?php

declare(strict_types=1);

namespace Juinsa\controllers;


class HomeController extends Controller
{


    public function index()
    {
        $this->viewManager->renderTemplate("index.twig.html");
    }
}