<?php


namespace Juinsa\controllers\Admin\Product;


class ProductRemoveAdminController extends ProductAdminController
{
    public function index()
    {

    }

    /**
     * @param integer $id
     */
    public function removeProduct($id)
    {
        if($this->productService->removeProduct($id)) {
            $this->sessionManager->getFlashBag()->add('success', 'Producto eliminado correctamente');
        } else {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar borrar el producto');
        }

        $this->redirectTo("/admin/products");
    }
}