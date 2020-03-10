<?php


namespace Juinsa\controllers\Auth;


use Juinsa\db\entities\User;

class UserRegisterController extends UserController
{
    public function index()
    {
        $this->myRenderTemplate('user/user_register.twig.html');
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

        if($user->id) {
            $mensaje = "Ya puedes administrar la web!";
            $this->sessionManager->getFlashBag()->add("success", $mensaje);
            $this->redirectTo("/admin/login");
            return;
        }

        $mensaje = "Lo sentimos! Ha ocurrido un error inesperado al intentar crear tu cuenta de usuario";
        $this->sessionManager->getFlashBag()->add("danger", $mensaje);
        $this->redirectTo("/admin/register");
    }
}