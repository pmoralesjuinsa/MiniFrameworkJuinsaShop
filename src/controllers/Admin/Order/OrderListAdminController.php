<?php


namespace Juinsa\controllers\Admin\Order;


class OrderListAdminController extends OrderAdminController
{
    public function index($orders = null)
    {
        if(is_null($orders)) {
            $orders = $this->orderService->getOrders();
        }
        $this->myRenderTemplate('admin/order/list.twig.html', ['orders' => $orders]);
    }

    public function search()
    {
        $orders = [];
        if(isset($_POST['nameOrId']) && $_POST['nameOrId'] != '') {
            $nameOrId = $_POST['nameOrId'];
            if(is_numeric($_POST['nameOrId'])) {
                $orders = $this->orderService->getOrderAdminList((int)$nameOrId);
            } else {
                $orders = $this->orderService->getOrderAdminList(null, $nameOrId);
            }
        }

        $this->index($orders);
    }
}