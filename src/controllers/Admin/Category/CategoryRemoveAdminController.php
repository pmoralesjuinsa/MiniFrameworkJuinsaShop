<?php


namespace Juinsa\controllers\Admin\Category;


class CategoryRemoveAdminController extends CategoryAdminController
{
    /**
     * @param integer $id
     */
    public function remove($id)
    {
        if($this->categoryService->remove($id)) {
            $this->sessionManager->getFlashBag()->add('success', 'Categoría eliminada correctamente');
        } else {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar borrar la categoría');
        }

        $this->redirectTo("/admin/category/list");
    }
}