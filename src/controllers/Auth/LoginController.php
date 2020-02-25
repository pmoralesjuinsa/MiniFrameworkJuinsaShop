<?php


namespace Juinsa\controllers;


use DI\Annotation\Inject;
use Juinsa\db\entities\User;
use Juinsa\Services\UserService;

class LoginController extends Controller
{
    /**
     * @Inject
     * @var UserService
     */
    private UserService $userService;

    public function index()
    {
        $this->viewManager->renderTemplate('login.twig.html');
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user->email = $email;
        $user->password = sha1($password);

        $userFound = $this->userService->selectUser($user);

        \Kint::dump($userFound);

//        $this->redirectTo("/");
    }
}