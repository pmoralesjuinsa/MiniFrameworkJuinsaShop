<?php


namespace Juinsa\controllers\Auth;


class UserPanelController extends UserController
{
    public function index()
    {
        $this->redirectIfNotLoguedAsUser();

        $this->myRenderTemplate('user/user_panel.twig.html');
    }

    public function a()
    {

    }

}