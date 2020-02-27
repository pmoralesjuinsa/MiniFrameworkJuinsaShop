<?php
declare(strict_types=1);

namespace Juinsa\controllers;

use Juinsa\SessionManager;
use Juinsa\ViewManager;

abstract class Controller
{

    /**
     * @Inject
     * @var SessionManager
     */
    protected SessionManager $sessionManager;

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
        $customerAuthed = $this->sessionManager->get('customerAuthed');
        $flashMessages = $this->sessionManager->getFlashBag()->all();

        $argsWithSession = array_merge($args, ["customerAuthed" => $customerAuthed], ["flashMessages" => $flashMessages]);

        $this->viewManager->renderTemplate($template, $argsWithSession);
    }


}