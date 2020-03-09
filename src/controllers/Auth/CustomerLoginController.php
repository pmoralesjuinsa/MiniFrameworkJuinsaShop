<?php


namespace Juinsa\controllers\Auth;


use DI\Annotation\Inject;
use Juinsa\db\entities\Customer;
use Juinsa\Services\CustomerService;
use Juinsa\controllers\Controller;

class CustomerLoginController extends Controller
{
    /**
     * @Inject
     * @var CustomerService
     */
    private CustomerService $customerService;

    public function index()
    {
        $this->myRenderTemplate('customer/customer_login.twig.html');
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $customer = new Customer();
        $customer->email = $email;
        $customer->password = sha1($password);

        $customerFound = $this->customerService->getCustomerByPasswordAndEmail($customer);

        $this->sessionManager->setCustomerAuthed($customerFound);

        if (!is_null($this->sessionManager->get('customerAuthed'))) {
            $this->redirectTo("/");
            return;
        }

        $this->sessionManager->getFlashBag()->add('danger', 'Wrong email and/or password');

        $this->redirectTo("/login");
    }

    public function logout()
    {
        $this->sessionManager->invalidate();

        $this->redirectTo("/");
    }
}