<?php


namespace Juinsa\controllers\Admin\Order;


class OrderRemoveAdminController extends OrderAdminController
{
    /**
     * @param integer $id
     */
    public function remove($id)
    {
        if($this->orderService->remove($id)) {
            $this->sessionManager->getFlashBag()->add('success', 'Pedido eliminada correctamente');
        } else {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar borrar el pedido');
        }

        $this->redirectTo("/admin/order/list");
    }
}