<?php


namespace Juinsa\controllers\Cart;


use Juinsa\db\entities\Order;
use Juinsa\db\entities\OrderLine;
use Juinsa\Services\CustomerService;
use Juinsa\Services\OrderService;
use Juinsa\Services\OrderStatusService;
use Juinsa\Services\ProductService;

class CartPayConfirmationController extends CartToolsPayController
{

    /**
     * @Inject
     * @var CustomerService
     */
    private CustomerService $customerService;

    /**
     * @Inject
     * @var OrderStatusService
     */
    private OrderStatusService $orderStatusService;

    /**
     * @Inject
     * @var OrderService
     */
    private OrderService $orderService;

    /**
     * @Inject
     * @var ProductService
     */
    private ProductService $productService;

    public function index()
    {
        $this->redirectIfNotLoguedAsCustomer();

        $cart = $this->initializeCart();

        $order = $this->createOrderAndPutToDB($cart);

        if (!$order->getOrderLines() || !$order->getId()) {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al crear el pedido');
        } else {
            $this->sessionManager->remove('cart');
            $this->sessionManager->getFlashBag()->add('success', 'Pedido pagado correctamente');
        }

        $this->myRenderTemplate("cart/cart-pay-confirmation.twig.html");
    }

    /**
     * @param array $cart
     * @return Order
     */
    protected function createOrderAndPutToDB(array $cart): Order
    {
        $status = $this->orderStatusService->getOrderStatusById(1);
        $customerSession = $this->customerService->getCustomerById($this->sessionManager->get('customerAuthed')->getId());

        $order = new Order();
        $order->setStatus($status);
        $order->setCustomer($customerSession);
        $order->setTotal($cart['totalAmount']);

        $this->createOrderLines($cart, $order);

        $order = $this->orderService->insertOrder($order);

        return $order;
    }

    /**
     * @param array $cart
     * @param Order $order
     */
    protected function createOrderLines(array $cart, Order &$order): void
    {
        foreach ($cart['cart'] as $idProduct => $product) {
            $productEntity = $this->productService->getProduct($idProduct);

            $orderLine = new OrderLine();
            $orderLine->setProduct($productEntity);
            $orderLine->setProductQuantity($product['quantity']);
            $orderLine->setProductPrice($product['price']);
            $orderLine->setTotal($product['total']);
            $orderLine->setProductName($productEntity->getName());

            $order->addOrderLines($orderLine);
        }
    }

}