<?php


namespace Juinsa\controllers\Cart;


class CartAjaxController extends CartController
{

    public function index()
    {

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

}