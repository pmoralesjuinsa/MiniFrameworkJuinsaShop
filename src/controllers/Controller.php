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
        $userAuthed = $this->sessionManager->get('userAuthed');
        $flashMessages = $this->sessionManager->getFlashBag()->all();
        $cart = $this->sessionManager->get('cart');

        $argsWithSession = array_merge(
            $args,
            ["customerAuthed" => $customerAuthed],
            ["flashMessages" => $flashMessages],
            ["cart" => $cart],
            ['userAuthed' => $userAuthed]
        );

        $this->viewManager->renderTemplate($template, $argsWithSession);
    }

    /**
     * @return void
     */
    protected function redirectIfNotLoguedAsCustomer(): void
    {
        if (!$this->sessionManager->has('customerAuthed')) {
            $this->sessionManager->getFlashBag()->add('info', 'Para poder acceder debes estar logueado como cliente');
            $this->redirectTo('/login');
        }
    }

    /**
     * @return void
     */
    protected function redirectIfLoguedAsCustomer(): void
    {
        if ($this->sessionManager->has('customerAuthed')) {
            $this->redirectTo('/');
        }
    }

    /**
     * @return void
     */
    protected function redirectIfNotLoguedAsUser(): void
    {
        if (!$this->sessionManager->has('userAuthed')) {
            $this->sessionManager->getFlashBag()->add('info', 'Sección disponible sólo para administradores');
            $this->redirectTo('/admin/login');
        }
    }

    /**
     * @return void
     */
    protected function redirectIfLoguedAsUser(): void
    {
        if ($this->sessionManager->has('userAuthed')) {
            $this->redirectTo('/admin/panel');
        }
    }

}