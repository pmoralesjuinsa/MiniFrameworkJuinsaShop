<?php


namespace Juinsa\controllers\Admin\ProductAttribute;


class ProductAttributeEditAdminController extends ProductAttributeAdminController
{
    /**
     * @param integer $id
     * @return void
     */
    public function edit($id): void
    {
        $productAttribute = $this->productAttributeService->getProductAttributeById($id);

        if(!$productAttribute) {
            $this->sessionManager->getFlashBag()->add('danger',
                'No se ha encontrado ningún atributo de producto con el id seleccionado');
        }

        $this->showCreatePage($productAttribute);
    }

    public function editSave($id)
    {
        if (!$this->checkIfAllVarsAreValid(true)) {
            $this->edit($id);
            die();
        }

        $productAttribute = $this->productAttributeService->getProductAttributeById((int)$id);

        $productAttribute->setName($_POST['name']);

        $this->productAttributeService->createProductAttribute($productAttribute);

        if (!$productAttribute) {
            $this->sessionManager->getFlashBag()->add('danger',
                "Ha ocurrido un error al intentar editar el atributo de producto");

            $this->showCreatePage($productAttribute);
        } else {
            $this->sessionManager->getFlashBag()->add('success',
                "Atributo de prodcuto editado correctamente");

            $this->redirectTo("/admin/productattribute/list");
        }
    }
}