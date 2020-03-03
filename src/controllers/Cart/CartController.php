<?php


namespace Juinsa\controllers\Cart;

use Juinsa\controllers\Controller;

class CartController extends Controller
{

    public function index()
    {
        $cart = $this->initializeCart();

        $this->myRenderTemplate("cart/cart.twig.html", ["cart" => $cart]);

    }

    public function addToCart()
    {
        if(!isset($_POST['cart'])) {
            return;
        }

        parse_str($_POST['cart'], $postVars);

        $cart = $this->initializeCart();

        $cart = $this->recalculateCart($cart, $postVars);

        $totalItems = 0;
        foreach ($cart['cart'] as $id_product => $quantity) {
            $totalItems += $quantity;
        }

        $cart['totalItems'] = $totalItems;

        $this->sessionManager->set('cart', $cart);

        echo json_encode($cart);
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
    protected function recalculateCart(array $cart, $postVars): array
    {
        if (isset($cart['cart'][$postVars['id_product']])) {
            $cart['cart'][$postVars['id_product']] += $postVars['quantity'];
        } else {
            $cart['cart'][$postVars['id_product']] = $postVars['quantity'];
        }
        return $cart;
    }
}