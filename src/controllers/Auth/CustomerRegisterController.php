<?php


namespace Juinsa\controllers\Auth;

use Juinsa\controllers\Controller;
use DI\Annotation\Inject;
use Juinsa\db\entities\Customer;
use Juinsa\Services\CustomerService;

class CustomerRegisterController extends Controller
{
    /**
     * @Inject
     * @var CustomerService
     */
    private CustomerService $customerService;

    public function index()
    {
        $this->myRenderTemplate('customer_register.twig.html');
    }

    public function register()
    {
        $customer = new User();
        $customer->name = $_POST['name'];
        $customer->email = $_POST['email'];
        $customer->phone = $_POST['phone'];
        $customer->address = $_POST['address'];
        $customer->password = sha1($_POST['password']);

        $this->customerService->createCustomer($customer);

        $this->redirectTo("/");
    }
}