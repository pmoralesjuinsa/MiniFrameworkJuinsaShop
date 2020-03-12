<?php


namespace Juinsa\controllers\Admin\Customer;


use Juinsa\controllers\Admin\AdminController;
use Juinsa\db\entities\Customer;
use Juinsa\Services\CustomerService;

class CustomerAdminController extends AdminController
{
    /**
     * @Inject
     * @var CustomerService
     */
    protected CustomerService $customerService;

    /**
     * @param Customer|null $customer
     */
    protected function showCreatePage($customer = null)
    {
        $this->myRenderTemplate('admin/customer/create.twig.html', ['$customer' => $customer]);
    }

    /**
     * @return void
     */
    protected function exitAftersShowsCreatePage(): void
    {
        $this->showCreatePage();
        die();
    }

    /**
     * @param bool $checkId
     * @return bool
     */
    protected function checkIfAllVarsAreValid($checkId = false): bool
    {
        if($checkId) {
            if(!isset($_POST['id']) || !is_numeric($_POST['id'])) {
                $this->sessionManager->getFlashBag()->add('danger', 'No hay un id válido');
                return false;
            }
        } else {
            if(empty($_POST['password'])) {
                $this->sessionManager->getFlashBag()->add('danger', 'La contraseña no puede estar en blanco');
                return false;
            }
        }

        if (empty($_POST['name'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'El nombre no puede estar en blanco');
            return false;
        }

        if(!empty($_POST['password'])) {
            if($_POST['password'] != $_POST['confirmPassword']) {
                $this->sessionManager->getFlashBag()->add('danger', 'Las contraseñas deben coincidir');
                return false;
            }
        }

        return true;
    }
}