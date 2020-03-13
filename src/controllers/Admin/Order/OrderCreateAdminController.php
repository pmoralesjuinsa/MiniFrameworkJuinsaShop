<?php


namespace Juinsa\controllers\Admin\Order;

use Juinsa\db\entities\Order;

class OrderCreateAdminController extends OrderAdminController
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

        $order = new Order();

        $this->orderProcessing($order);

        if (!$order) {
            $this->sessionManager->getFlashBag()->add('danger',
                "Ha ocurrido un error al intentar insertar el pedido");
        } else {
            $this->sessionManager->getFlashBag()->add('success',
                "Pedido añadido correctamente");
        }

        $this->showCreatePage();
    }

    /**
     * @param Order $order
     */
    protected function orderProcessing(&$order): void
    {
        $postVars = $_POST['order'];

        $order->setTotal($postVars['total']);

        $this->setCustomerToOrder((int)$postVars['customer'], $order);

        $this->setOrderStatusToOrder((int)$postVars['orderStatus'], $order);

        $this->buildOrderLines($postVars, $order);
    }

}