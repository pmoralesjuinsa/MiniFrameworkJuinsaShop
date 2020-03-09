<?php


namespace Juinsa\controllers\Cart;


use Juinsa\controllers\Controller;
use Juinsa\Services\ProductService;

class CartToolsPayController extends Controller
{

    /**
     * @Inject
     * @var ProductService
     */
    private ProductService $productService;

    public function index()
    {

    }

    //MOVER FUERA - USADO POR TODOS

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
     * @return void
     */
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

    //MOVER FUERA - USADO AQUI EN CART Y EN CARTPAY

    //---------------- CART MODIFY PROCESSING ----------------
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

    //---------------- END CART MODIFY PROCESSING ----------------

    //USADO POR CART Y CART AJAX

    //---------- PROCESO REFACTORIZADO ---------
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
    //---------- END PROCESO REFACTORIZADO ---------

}