<?php


namespace Juinsa\controllers\Cart;


class CartPayController extends CartToolsPayController
{

    public function index()
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

}