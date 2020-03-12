<?php


namespace Juinsa\controllers\Admin\Customer;


class CustomerRemoveAdminController extends CustomerAdminController
{
    /**
     * @param integer $id
     */
    public function remove($id)
    {
        if($this->customerService->remove($id)) {
            $this->sessionManager->getFlashBag()->add('success', 'Cliente eliminado correctamente');
        } else {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar borrar el cliente');
        }

        $this->redirectTo("/admin/customer/list");
    }
}