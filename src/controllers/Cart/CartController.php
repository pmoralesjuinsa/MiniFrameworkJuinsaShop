<?php


namespace Juinsa\controllers\Cart;

use Juinsa\controllers\Controller;
use Juinsa\Services\ProductService;

class CartController extends Controller
{

    /**
     * @Inject
     * @var ProductService
     */
    private ProductService $productService;

    public function index()
    {
        $cart = $this->initializeCart();

        $this->myRenderTemplate("cart/cart.twig.html", ["cart" => $cart]);

    }

    public function addToCart()
    {
        try {
            if(!isset($_POST['cart'])) {
                return;
            }

            parse_str($_POST['cart'], $postVars);

            $cart = $this->initializeCart();

            $cart = $this->quantifyProductsCart($cart, $postVars);

            $cart = $this->getCartProductsInfo($cart);

            $cart = $this->getTotalCartAmount($cart);

            $cart['totalItems'] = 0;
            foreach ($cart['cart'] as $id_product => $values) {
                $cart['totalItems'] += $values['quantity'];
            }

            $this->sessionManager->set('cart', $cart);

            $this->sessionManager->getFlashBag()->add('success', 'Producto añadido correctamente a tu carrito');
        } catch (\Exception $exception) {
            $this->sessionManager->getFlashBag()->add('error', 'Ha ocurrido un error al intentar añadir el producto a tu carrito');
        }

        ob_start();
        $this->myRenderTemplate("lists/messages_list.twig.html");
        $cart['messages'] = ob_get_clean();

        echo json_encode($cart);
    }

    public function cartPay()
    {
        $this->myRenderTemplate("cart/cart-pay.twig.html");
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
     * @return array
     */
    protected function quantifyProductsCart(array $cart, $postVars): array
    {
        if (isset($cart['cart'][$postVars['id_product']])) {
            $cart['cart'][$postVars['id_product']]['quantity'] += $postVars['quantity'];
        } else {
            $cart['cart'][$postVars['id_product']]['quantity'] = $postVars['quantity'];
        }
        return $cart;
    }

    protected function getCartProductsInfo($cart)
    {
        $productsId = array_keys($cart['cart']);

        $productsInfo = $this->productService->getProductsInfo($productsId);

        foreach ($productsInfo as $product) {
            $cart['cart'][$product->productId]['name'] = $product->name;
            $cart['cart'][$product->productId]['price'] = $product->price;
            $cart['cart'][$product->productId]['total'] = $cart['cart'][$product->productId]['quantity'] * $product->price;
        }

        return $cart;
    }

    /**
     * @param array $cart
     * @return array
     */
    protected function getTotalCartAmount(array $cart)
    {
        $cart['totalAmount'] = 0;
        foreach ($cart['cart'] as $idProd => $values) {
            $cart['totalAmount'] += $values['quantity'] * $values['price'];
        }

        return $cart;
    }
}