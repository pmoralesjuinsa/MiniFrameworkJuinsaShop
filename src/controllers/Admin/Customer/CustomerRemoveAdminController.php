<?php


namespace Juinsa\controllers\Admin\User;


class CustomerRemoveAdminController extends CustomerAdminController
{
    /**
     * @param integer $id
     */
    public function remove($id)
    {
        if($this->userService->remove($id)) {
            $this->sessionManager->getFlashBag()->add('success', 'Usuario eliminado correctamente');
        } else {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar borrar el usuario');
        }

        $this->redirectTo("/admin/user/list");
    }
}