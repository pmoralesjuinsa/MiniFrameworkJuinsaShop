<?php


namespace Juinsa\controllers\Auth;


use DI\Annotation\Inject;
use Juinsa\db\entities\Customer;
use Juinsa\Services\CustomerService;
use Juinsa\controllers\Controller;
use Juinsa\Services\OrderService;

class CustomerPanelController extends Controller
{
    /**
     * @Inject
     * @var CustomerService
     */
    private CustomerService $customerService;

    /**
     * @Inject
     * @var OrderService
     */
    private OrderService $orderService;

    public function index()
    {
        $orders = $this->orderService->getOrdersByIdCustomer($this->sessionManager->get('customerAuthed')->getId());

        $this->myRenderTemplate('customer_panel.twig.html', ['orders' => $orders]);
    }
}