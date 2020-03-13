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

        $this->setCustomerToOrder($order);

        $this->setOrderStatusToOrder($order);

        $order->setTotal($_POST['total']);

        $order = $this->orderService->insertOrder($order);

        if (!$order->getId()) {
            $this->sessionManager->getFlashBag()->add('danger',
                "Ha ocurrido un error al intentar insertar el pedido");
        } else {
            $this->sessionManager->getFlashBag()->add('success',
                "Pedido añadido correctamente");
        }

        $this->showCreatePage($order);
    }

    /**
     * @param Order $order
     */
    protected function setCustomerToOrder(Order &$order): void
    {
        $customer = $this->customerService->getCustomerById((int)$_POST['customer']);
        $order->setCustomer($customer);
    }

    /**
     * @param Order $order
     */
    protected function setOrderStatusToOrder(Order &$order): void
    {
        $status = $this->orderStatusService->getOrderStatusById((int)$_POST['orderStatus']);
        $order->setStatus($status);
    }

}