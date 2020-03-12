<?php


namespace Juinsa\controllers\Admin\ProductAttribute;


class ProductAttributeRemoveAdminController extends ProductAttributeAdminController
{
    /**
     * @param integer $id
     */
    public function remove($id)
    {
        if($this->productAttributeService->remove($id)) {
            $this->sessionManager->getFlashBag()->add('success', 'Atributo de producto eliminada correctamente');
        } else {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar borrar el atributo de producto');
        }

        $this->redirectTo("/admin/productattribute/list");
    }
}