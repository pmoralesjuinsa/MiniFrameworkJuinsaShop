<?php


namespace Juinsa\controllers\Cart;

use Juinsa\controllers\Controller;

class CartController extends Controller
{
    public function index()
    {

    }

    public function addToCart()
    {
        if(!isset($_POST['cart'])) {
            return;
        }

        parse_str($_POST['cart'], $postVars);

        if(!$this->sessionManager->has('Cart')) {
            $this->sessionManager->set('Cart', []);
        }

        $cart['cart'] = $this->sessionManager->get('Cart');

        if(isset($cart[$postVars['id_product']])) {
            $cart['cart'][$postVars['id_product']] += $postVars['quantity'];
        } else {
            $cart['cart'][$postVars['id_product']] = $postVars['quantity'];
        }

        $total_items = 0;
        foreach ($cart['cart'] as $id_product => $quantity) {
            $total_items += $quantity;
        }

        $cart['total_items'] = $total_items;
        echo json_encode($cart);
    }
}