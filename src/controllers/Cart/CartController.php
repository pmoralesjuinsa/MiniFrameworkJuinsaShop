<?php


namespace Juinsa\controllers\Cart;

use Juinsa\controllers\Controller;
use Juinsa\Services\OrderService;
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

    public function index()
    {
        $cart = $this->initializeCart();

        if(empty($cart)) {
            $this->sessionManager->getFlashBag()->add('warning', 'No tienes ningún producto en tu carrito');
        }

        $this->myRenderTemplate("cart/cart.twig.html", ["cart" => $cart]);

    }

    public function addToCart()
    {
        try {
            if(!isset($_POST['cart'])) {
                $this->sessionManager->getFlashBag()->add('danger', 'Carrito no disponible');
            }

            parse_str($_POST['cart'], $postVars);

            $cart = $this->initializeCart();

            $this->increaseProductsCart($cart, $postVars);

            $this->cartProcessing($cart);

            $this->sessionManager->getFlashBag()->add('success', 'Producto añadido correctamente a tu carrito');
        } catch (\Exception $exception) {
            $this->sessionManager->getFlashBag()->add('danger', 'Ha ocurrido un error al intentar añadir el producto a tu carrito');
        }

        $this->renderMessagesToAjaxCart($cart);

        echo json_encode($cart);
    }

    public function cartModifyQuantity()
    {
        try {
            $this->checkIfValuesToModifyQuantityAreValids();

            $cart = $this->initializeCart();

            $postVars = ['quantity' => (int)$_POST['quantity'], 'id_product' => (int)$_POST['id_product']];

            $cart['cart'][$postVars['id_product']]['quantity'] = $postVars['quantity'];

            $this->cartProcessing($cart);

        } catch (\Exception $exception) {
            $this->sessionManager->getFlashBag()->add('danger', 'Ha ocurrido un error al intentar modificar el carrito');
        }

        $this->renderMessagesToAjaxCart($cart);

        echo json_encode($cart);
    }

    public function cartPay()
    {
        $this->redirectIfNotLogued();

        $this->myRenderTemplate("cart/cart-pay.twig.html");
    }

    public function cartPayConfirmation()
    {
        $this->redirectIfNotLogued();
//
        $cart = $this->initializeCart();
//
//        $order = new
//
//        $ok = $this->orderService->createOrder($order);
//
        if(!$ok) {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al crear el pedido');
        } else {
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

        $productsInfo = $this->productService->getProductsInfo($productsId);

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

    protected function checkIfValuesToModifyQuantityAreValids(): void
    {
        if (!isset($_POST['quantity']) || !isset($_POST['id_product'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'Datos insuficientes para modificar el carrito');
            return;
        }

        if (!is_numeric($_POST['quantity']) || !is_numeric($_POST['id_product'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'Los datos introducidos no son válidos');
            return;
        }
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
        $this->getCartProductsInfo($cart);

        $this->getTotalCartAmount($cart);

        $this->getTotalItemsCart($cart);

        $this->sessionManager->set('cart', $cart);
    }
}