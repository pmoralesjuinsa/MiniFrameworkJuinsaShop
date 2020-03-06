<?php


namespace Juinsa\controllers\Cart;


use Juinsa\controllers\Controller;
use Juinsa\db\entities\Order;
use Juinsa\db\entities\OrderLine;
use Juinsa\Services\CustomerService;
use Juinsa\Services\OrderService;
use Juinsa\Services\OrderStatusService;
use Juinsa\Services\ProductService;

class CartController extends Controller
{

    /**
     * @Inject
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * @Inject
     * @var OrderService
     */
    private OrderService $orderService;

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

    public function index()
    {
        $cart = $this->initializeCart();

        if (empty($cart) || empty($cart['cart'])) {
            $this->sessionManager->getFlashBag()->add('warning', 'No tienes ningún producto en tu carrito');
        }

        $this->myRenderTemplate("cart/cart.twig.html", ["cart" => $cart]);

    }

    public function addToCart()
    {
        try {
            if (!isset($_POST['cart'])) {
                $this->sessionManager->getFlashBag()->add('danger', 'Carrito no disponible');
            }

            parse_str($_POST['cart'], $postVars);

            $cart = $this->initializeCart();

            $this->increaseProductsCart($cart, $postVars);

            $this->cartProcessing($cart);

            $this->sessionManager->getFlashBag()->add('success', 'Producto añadido correctamente a tu carrito');
        } catch (\Exception $exception) {
            $this->sessionManager->getFlashBag()->add('danger',
                'Ha ocurrido un error al intentar añadir el producto a tu carrito');
        }

        $this->renderMessagesToAjaxCart($cart);

        echo json_encode($cart);
    }

    public function cartModifyQuantity()
    {
        $cart = $this->initializeCart();

        if (!isset($_POST['quantity']) || !isset($_POST['id_product'])) {
            $this->sessionManager->getFlashBag()->add(
                'danger',
                'Datos insuficientes para modificar el carrito'
            );
        } else {
            $this->cartModifyProcessing($cart, $_POST['id_product'], $_POST['quantity']);
        }

        $this->renderMessagesToAjaxCart($cart);

        echo json_encode($cart);
    }

    public function cartModifyProcessing(&$cart, $idProduct = null, $quantity = null)
    {
        try {
            if (!$this->checkIfValuesToModifyQuantityAreValids($idProduct, $quantity)) {
                $this->renderMessagesToAjaxCart($cart);
                echo json_encode($cart);
                return;
            }

            $this->setProductQuantity($cart, $idProduct, $quantity);

            $this->cartProcessing($cart);

        } catch (\Exception $exception) {
            $this->sessionManager->getFlashBag()->add(
                'danger',
                'Ha ocurrido un error al intentar modificar el carrito'
            );
        }
    }

    public function cartPay()
    {
        $this->redirectIfNotLogued();

        $cart = $this->initializeCart();

        $quantities = $_POST['quantities'];
        $productsId = $_POST['id_products'];

        foreach ($quantities as $key => $quantity) {
            $this->cartModifyProcessing($cart, $productsId[$key], $quantity);
        }

        $this->myRenderTemplate("cart/cart-pay.twig.html");
    }

    public function cartPayConfirmation()
    {
        $this->redirectIfNotLogued();

        $cart = $this->initializeCart();

        $order = $this->createOrderAndPutToDB($cart);

        if (!$order->getOrderLines() || !$order->getId()) {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al crear el pedido');
        } else {
            $this->sessionManager->remove('cart');
            $this->sessionManager->getFlashBag()->add('success', 'Pedido pagado correctamente');
        }
//
        $this->myRenderTemplate("cart/cart-pay-confirmation.twig.html");
    }


    /**
     * @return array
     */
    protected function initializeCart(): array
    {
        if (!$this->sessionManager->has('cart')) {
            $this->sessionManager->set('cart', []);
        }

        return $this->sessionManager->get('cart');
    }

    /**
     * @param array $cart
     * @param $postVars
     */
    protected function increaseProductsCart(array &$cart, $postVars): void
    {
        if (isset($cart['cart'][$postVars['id_product']])) {
            $cart['cart'][$postVars['id_product']]['quantity'] += (int)$postVars['quantity'];
        } else {
            $cart['cart'][$postVars['id_product']]['quantity'] = (int)$postVars['quantity'];
        }
    }

    /**
     * @param array $cart
     */
    protected function getCartProductsInfo(array &$cart): void
    {

        $productsId = array_keys($cart['cart']);

        $productsInfo = $this->productService->getProductsPrice($productsId);

        foreach ($productsInfo as $product) {
            $cart['cart'][$product->productId]['name'] = $product->name;
            $cart['cart'][$product->productId]['price'] = $product->price;
            $cart['cart'][$product->productId]['total'] = $cart['cart'][$product->productId]['quantity'] * $product->price;
        }

    }

    /**
     * @param array $cart
     */
    protected function getTotalCartAmount(array &$cart)
    {
        $cart['totalAmount'] = 0;
        foreach ($cart['cart'] as $idProd => $values) {
            $cart['totalAmount'] += $values['quantity'] * $values['price'];
        }
    }

    protected function redirectIfNotLogued(): void
    {
        if (!$this->sessionManager->has('customerAuthed')) {
            //TODO este mensaje flash no va
            $this->sessionManager->getFlashBag()->add('info', 'Debes estar logueado para poder comprar');
            $this->redirectTo('/login');
        }
    }

    /**
     * @param array $cart
     */
    protected function renderMessagesToAjaxCart(array &$cart): void
    {
        ob_start();
        $this->myRenderTemplate("lists/messages_list.twig.html");
        $cart['messages'] = ob_get_clean();
    }

    /**
     * @return bool
     */
    protected function checkIfValuesToModifyQuantityAreValids($idProduct, $quantity): bool
    {
        if (!is_numeric($quantity) || !is_numeric($idProduct)) {
            $this->sessionManager->getFlashBag()->add('danger', 'Los datos introducidos no son válidos');
            return false;
        }

        return true;
    }

    /**
     * @param array $cart
     */
    protected function getTotalItemsCart(array &$cart): void
    {
        $cart['totalItems'] = 0;
        foreach ($cart['cart'] as $id_product => $values) {
            $cart['totalItems'] += $values['quantity'];
        }
    }

    /**
     * @param array $cart
     */
    protected function cartProcessing(array &$cart): void
    {
        if (empty($cart['cart'])) {
            $this->sessionManager->getFlashBag()->add('warning', 'Su carrito está vacío');
            $cart = [];
            $this->sessionManager->set('cart', $cart);
            return;
        }

        $this->getCartProductsInfo($cart);

        $this->getTotalCartAmount($cart);

        $this->getTotalItemsCart($cart);

        $this->sessionManager->set('cart', $cart);
    }

    /**
     * @param array $cart
     */
    protected function setProductQuantity(array &$cart, $idProduct, $quantity): void
    {
        $postVars = ['quantity' => (int)$quantity, 'id_product' => (int)$idProduct];

        if ($postVars['quantity'] == 0) {
            unset($cart['cart'][$postVars['id_product']]);
        } elseif ($postVars['quantity'] > 0) {
            $cart['cart'][$postVars['id_product']]['quantity'] = $postVars['quantity'];
        }
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
}