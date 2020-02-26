<?php


namespace Juinsa\controllers\Auth;


use DI\Annotation\Inject;
use Juinsa\db\entities\Customer;
use Juinsa\Helpers\CustomerHelper;
use Juinsa\Services\CustomerService;
use Juinsa\controllers\Controller;

class LoginController extends Controller
{
    /**
     * @Inject
     * @var CustomerService
     */
    private CustomerService $customerService;

    public function index()
    {
        $this->viewManager->renderTemplate('login.twig.html');
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $customer = new Customer();
        $customer->email = $email;
        $customer->password = sha1($password);

        $userFound = $this->customerService->login($customer);

        CustomerHelper::setAuthenticatedCustomer($userFound);

        var_dump(CustomerHelper::getAuthenticatedCustomer());

        \Kint::dump($userFound);

//        $this->redirectTo("/");
    }
}