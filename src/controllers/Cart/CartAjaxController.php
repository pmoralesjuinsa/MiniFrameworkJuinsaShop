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
            $cart = $this->initializeCart();

            if (!isset($_POST['cart'])) {
                $this->sessionManager->getFlashBag()->add('danger', 'Carrito no disponible');
            } else {
                parse_str($_POST['cart'], $postVars);


                if (!isset($postVars['quantity']) || (int)$postVars['quantity'] <= 0) {
                    $this->sessionManager->getFlashBag()->add('danger', 'Tienes que elegir una cantidad válida');
                } else {

                    $this->increaseProductsCart($cart, $postVars);

                    $this->cartProcessing($cart);

                    $this->sessionManager->getFlashBag()->add('success', 'Producto añadido correctamente a tu carrito');
                }
            }
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

}