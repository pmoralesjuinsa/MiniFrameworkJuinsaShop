<?php


namespace Juinsa\controllers\Auth;

use Juinsa\db\entities\User;

class UserLoginController extends UserController
{
    public function index()
    {
        $this->redirectIfLoguedAsUser();

        $this->myRenderTemplate('user/user_login.twig.html');
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user->email = $email;
        $user->password = sha1($password);

        $userFound = $this->userService->getUserByPasswordAndEmail($user);

        $this->sessionManager->setUserAuthed($userFound);

        if (!is_null($this->sessionManager->get('userAuthed'))) {
            $this->redirectTo("/admin/panel");
            return;
        }

        $this->sessionManager->getFlashBag()->add('danger', 'Wrong email and/or password');

        $this->redirectTo("/admin/login");
    }

}