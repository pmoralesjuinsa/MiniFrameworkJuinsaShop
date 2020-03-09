<?php


namespace Juinsa\controllers\Auth;

use Juinsa\db\entities\User;

class UserLoginController extends UserController
{
    public function index()
    {
        $this->myRenderTemplate('register_user.twig.html');
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $customer = new User();
        $customer->email = $email;
        $customer->password = sha1($password);

        $userFound = $this->userService->getUserByPasswordAndEmail($customer);

        $this->sessionManager->setUserAuthed($userFound);

        if (!is_null($this->sessionManager->get('userAuthed'))) {
            $this->redirectTo("/admin/panel");
            return;
        }

        $this->sessionManager->getFlashBag()->add('danger', 'Wrong email and/or password');

        $this->redirectTo("/admin-login");
    }

    public function logout()
    {
        $this->sessionManager->invalidate();

        $this->redirectTo("/");
    }
}