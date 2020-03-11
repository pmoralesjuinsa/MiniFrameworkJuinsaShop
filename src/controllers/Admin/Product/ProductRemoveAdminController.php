<?php


namespace Juinsa\controllers\Admin\Product;


class ProductRemoveAdminController extends ProductAdminController
{
    public function index()
    {

    }

    /**
     * @param integer $idProduct
     */
    public function removeProduct($idProduct)
    {
        if($this->productService->removeProduct($idProduct)) {
            $this->sessionManager->getFlashBag()->add('success', 'Producto eliminado correctamente');
        } else {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar borrar el producto');
        }

        $this->redirectTo("/admin/products");
    }
}