<?php


namespace Juinsa\controllers\Auth;

use Juinsa\controllers\Controller;
use DI\Annotation\Inject;
use Juinsa\db\entities\User;
use Juinsa\Services\UserService;

class RegisterController extends Controller
{
    /**
     * @Inject
     * @var UserService
     */
    private UserService $userService;

    public function index()
    {
        $this->myRenderTemplate('register.twig.html');
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