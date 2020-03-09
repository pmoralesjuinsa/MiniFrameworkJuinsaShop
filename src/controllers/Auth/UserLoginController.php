<?php


namespace Juinsa\controllers\Auth;

use Juinsa\db\entities\User;

class UserLoginController extends UserController
{
    public function index()
    {
        $this->myRenderTemplate('register_user.twig.html');
    }

    public function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = sha1($password);

        $this->userService->createUser($user);

        $this->redirectTo("/");
    }
}