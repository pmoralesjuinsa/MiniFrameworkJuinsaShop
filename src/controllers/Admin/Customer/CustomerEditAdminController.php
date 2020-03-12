<?php


namespace Juinsa\controllers\Admin\Customer;


class CustomerEditAdminController extends CustomerAdminController
{
    /**
     * @param integer $id
     * @return void
     */
    public function edit($id): void
    {
        $customer = $this->customerService->getCustomerById($id);

        if(!$customer) {
            $this->sessionManager->getFlashBag()->add('danger',
                'No se ha encontrado ningún cliente con el id seleccionado');
        }

        $this->showCreatePage($customer);
    }

    public function editSave($id)
    {
        if (!$this->checkIfAllVarsAreValid(true)) {
            $this->edit($id);
            die();
        }

        $customer = $this->customerService->getCustomerById((int)$id);

        $customer->setName($_POST['name']);
        $customer->setEmail($_POST['email']);
        $customer->setPhone($_POST['phone']);
        $customer->setAddress($_POST['address']);
        if(!empty($_POST['password'])) {
            $customer->setPassword(sha1($_POST['password']));
        }

        $this->customerService->createCustomer($customer);

        if (!$customer) {
            $this->sessionManager->getFlashBag()->add('danger',
                "Ha ocurrido un error al intentar editar el cliente");

            $this->showCreatePage($customer);
        } else {
            $this->sessionManager->getFlashBag()->add('success',
                "Cliente editado correctamente");

            $this->redirectTo("/admin/customer/list");
        }
    }
}