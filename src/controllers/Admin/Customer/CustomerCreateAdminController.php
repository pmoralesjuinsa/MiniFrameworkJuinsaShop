<?php


namespace Juinsa\controllers\Admin\Customer;

use Juinsa\db\entities\Customer;

class CustomerCreateAdminController extends CustomerAdminController
{

    public function index()
    {
        $this->showCreatePage();
    }

    public function create()
    {
        if (!$this->checkIfAllVarsAreValid()) {
            $this->exitAftersShowsCreatePage();
        }

        $customer = new Customer();

        $customer->setName($_POST['name']);
        $customer->setEmail($_POST['email']);
        $customer->setPhone($_POST['phone']);
        $customer->setAddress($_POST['address']);
        $customer->setPassword(sha1($_POST['password']));

        $this->customerService->createCustomer($customer);

        if(!$customer->getId()) {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar insertar el cliente');
        } else {
            $this->sessionManager->getFlashBag()->add('success', 'Cliente insertado correctamente');
        }

        $this->showCreatePage();
    }

}