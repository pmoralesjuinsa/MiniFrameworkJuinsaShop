<?php


namespace Juinsa\controllers\Admin\Order;


class OrderEditAdminController extends OrderAdminController
{
    /**
     * @param integer $id
     * @return void
     */
    public function edit($id): void
    {
        $order = $this->orderService->getOrderById($id);

        if(!$order) {
            $this->sessionManager->getFlashBag()->add('danger',
                'No se ha encontrado ningún pedido con el id seleccionado');
        }

        $this->showCreatePage($order);
    }

    public function editSave($id)
    {
        if (!$this->checkIfAllVarsAreValid(true)) {
            $this->edit($id);
            die();
        }

        $order = $this->orderService->getOrderById((int)$id);

        $this->orderProcessing($order);

        if (!$order->getId()) {
            $this->sessionManager->getFlashBag()->add('danger',
                "Ha ocurrido un error al intentar editar el pedido");

        } else {
            $this->sessionManager->getFlashBag()->add('success',
                "Pedido editado correctamente");
        }

        $this->showCreatePage($order);
    }
}