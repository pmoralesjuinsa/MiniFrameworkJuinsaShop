<?php


namespace Juinsa\controllers\Admin\Order;


use Juinsa\controllers\Admin\AdminController;
use Juinsa\db\entities\Order;
use Juinsa\Services\CustomerService;
use Juinsa\Services\OrderService;
use Juinsa\Services\OrderStatusService;

class OrderAdminController extends AdminController
{
    /**
     * @Inject
     * @var OrderService
     */
    protected OrderService $orderService;

    /**
     * @Inject
     * @var CustomerService
     */
    protected CustomerService $customerService;

    /**
     * @Inject
     * @var OrderStatusService
     */
    protected OrderStatusService $orderStatusService;

    /**
     * @param Order|null $order
     */
    protected function showCreatePage($order = null)
    {
        $customers = $this->customerService->getCustomers();
        $orderStatus = $this->orderStatusService->getOrderStatus();

        $this->myRenderTemplate('admin/order/create.twig.html',
            ['order' => $order, 'orderStatus' => $orderStatus, 'customers' => $customers]);
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
     * @param Order $order
     */
    protected function orderProcessing(&$order)
    {
        $this->setCustomerToOrder($order);

        $this->setOrderStatusToOrder($order);

        $order->setTotal($_POST['total']);

        $order = $this->orderService->insertOrder($order);
    }

    /**
     * @param Order $order
     */
    protected function setCustomerToOrder(Order &$order): void
    {
        if(!$order->getId() || ($order->getId() && $order->getCustomer()->getId() != $_POST['customer'])) {
            $customer = $this->customerService->getCustomerById((int)$_POST['customer']);
        } else {
            $customer = $order->getCustomer();
        }

        $order->setCustomer($customer);
    }

    /**
     * @param Order $order
     */
    protected function setOrderStatusToOrder(Order &$order): void
    {
        if(!$order->getId() || ($order->getId() && $order->getStatus()->getId() != $_POST['orderStatus'])) {
            $status = $this->orderStatusService->getOrderStatusById((int)$_POST['orderStatus']);
        } else {
            $status = $order->getStatus();
        }


        $order->setStatus($status);
    }

    /**
     * @param bool $checkId
     * @return bool
     */
    protected function checkIfAllVarsAreValid($checkId = false): bool
    {

        if ($checkId) {
            if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
                $this->sessionManager->getFlashBag()->add('danger', 'No hay un id válido');
                return false;
            }
        }

        if (empty($_POST['customer']) || !is_numeric($_POST['customer'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'Debes elegir un cliente válido');
            return false;
        }

        if (empty($_POST['orderStatus']) || !is_numeric($_POST['orderStatus'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'Debes elegir un estado de pedido válido');
            return false;
        }

        if (!isset($_POST['total']) || !is_numeric($_POST['total'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'El total no es válido');
            return false;
        }

        return true;
    }
}