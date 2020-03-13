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

        if (empty($_POST['name'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'El nombre no puede estar en blanco');
            return false;
        }

        return true;
    }
}