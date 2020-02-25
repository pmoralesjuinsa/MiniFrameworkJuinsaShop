<?php


namespace Juinsa\controllers\Auth;


use DI\Annotation\Inject;
use Juinsa\db\entities\Customer;
use Juinsa\Services\CustomerService;
use Juinsa\controllers\Controller;

class LoginController extends Controller
{
    /**
     * @Inject
     * @var CustomerService
     */
    private CustomerService $userService;

    public function index()
    {
        $this->viewManager->renderTemplate('login.twig.html');
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new Customer();
        $user->email = $email;
        $user->password = sha1($password);

        $userFound = $this->userService->selectUser($user);

        \Kint::dump($userFound);

//        $this->redirectTo("/");
    }
}