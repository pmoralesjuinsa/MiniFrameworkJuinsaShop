<?php
declare(strict_types=1);

namespace Juinsa\controllers;


class WhoController extends Controller
{

    public function index()
    {
        $this->viewManager->renderTemplate('who.twig.html');
    }
}