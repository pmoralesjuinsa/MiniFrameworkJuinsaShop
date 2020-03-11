<?php


namespace Juinsa\controllers\Admin\ProductType;


class ProductTypeRemoveAdminController extends ProductTypeAdminController
{
    /**
     * @param integer $id
     */
    public function remove($id)
    {
        if($this->productTypeService->remove($id)) {
            $this->sessionManager->getFlashBag()->add('success', 'Tipo de producto eliminado correctamente');
        } else {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar borrar el tipo de producto');
        }

        $this->redirectTo("/admin/producttype/list");
    }
}