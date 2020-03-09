<?php


namespace Juinsa\controllers\Cart;


class CartController extends CartToolsPayController
{

    public function index()
    {
        $cart = $this->initializeCart();

        if (empty($cart) || empty($cart['cart'])) {
            $this->sessionManager->getFlashBag()->add('warning', 'No tienes ningún producto en tu carrito');
        }

        $this->myRenderTemplate("cart/cart.twig.html", ["cart" => $cart]);
    }


}