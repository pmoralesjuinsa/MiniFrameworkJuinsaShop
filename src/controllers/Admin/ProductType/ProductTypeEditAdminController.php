<?php


namespace Juinsa\controllers\Admin\ProductType;


class ProductTypeEditAdminController extends ProductTypeAdminController
{
    /**
     * @param integer $id
     * @return void
     */
    public function edit($id): void
    {
        $productType = $this->productTypeService->getProductTypeById($id);

        if(!$productType) {
            $this->sessionManager->getFlashBag()->add('danger',
                'No se ha encontrado ningún tipo de producto con el id seleccionado');
        }

        $this->showCreatePage($productType);
    }

    public function editSave($id)
    {
        if (!$this->checkIfAllVarsAreValid(true)) {
            $this->edit($id);
            die();
        }

        $productType = $this->productTypeService->getProductTypeById((int)$id);

        $productType->setName($_POST['name']);

        $this->productTypeService->createProductType($productType);

        if (!$productType) {
            $this->sessionManager->getFlashBag()->add('danger',
                "Ha ocurrido un error al intentar editar el tipo de producto");

            $this->showCreatePage($productType);
        } else {
            $this->sessionManager->getFlashBag()->add('success',
                "Tipo de producto editada correctamente");

            $this->redirectTo("/admin/producttype/list");
        }
    }
}