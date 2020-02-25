<?php

declare(strict_types=1);

namespace Juinsa\controllers;


use Juinsa\db\entities\User;
use Kint\Kint;

class HomeController extends Controller
{


    public function index()
    {
//        $users = $this->doctrineManager->em->getRepository(User::class)->findAll();

        $this->viewManager->renderTemplate("index.twig.html");
    }
}