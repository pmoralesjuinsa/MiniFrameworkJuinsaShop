<?php
declare(strict_types=1);

namespace Juinsa\controllers;

use Juinsa\ViewManager;

abstract class Controller
{


    protected $sessionmanager;

    protected ViewManager $viewManager;

    public function __construct(ViewManager $viewManager)
    {
        $this->viewManager = $viewManager;
    }

    public abstract function index();

    public function redirectTo(string $page)
    {
        $host = $_SERVER['HTTP_HOST'];
        header("location: http://$host$page");
    }

    public function myRenderTemplate($template, $args = [])
    {
        $customerAuthed = (array)getAuthenticatedCustomer();
        $argsWithSession = array_merge($args, ["customerAuthed" => $customerAuthed]);

        $this->viewManager->renderTemplate($template, $argsWithSession);
    }


}