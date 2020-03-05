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
        $this->myRenderTemplate('customer/customer_register.twig.html');
    }

    public function register()
    {
        $customer = new Customer();
        $customer->name = $_POST['name'];
        $customer->email = $_POST['email'];
        $customer->phone = $_POST['phone'];
        $customer->address = $_POST['address'];
        $customer->password = sha1($_POST['password']);

        $this->customerService->createCustomer($customer);

        if($customer->id) {
            $mensaje = "Genial! Te has registrado como cliente! Esperamos que tu experiencia sea increíble!";
            $this->sessionManager->getFlashBag()->add("success", $mensaje);
            $this->redirectTo("/login");
            return;
        }

        $mensaje = "Lo sentimos! Ha ocurrido un error inesperado al intentar crear tu cuenta de cliente";
        $this->sessionManager->getFlashBag()->add("danger", $mensaje);
        $this->redirectTo("/register");
    }
}