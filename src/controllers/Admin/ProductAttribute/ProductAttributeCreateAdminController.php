<?php


namespace Juinsa\controllers\Admin\ProductAttribute;


use Juinsa\db\entities\ProductAttribute;

class ProductAttributeCreateAdminController extends ProductAttributeAdminController
{

    public function index()
    {
        $this->showCreatePage();
    }

    public function create()
    {
        $this->checkIfAllVarsAreValid();

        $productAttribute = new ProductAttribute();

        $productAttribute->setName($_POST['name']);

        $this->productAttributeService->createProductAttribute($productAttribute);

        if(!$productAttribute->getId()) {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar insertar el atributo de producto');
        } else {
            $this->sessionManager->getFlashBag()->add('success', 'Atributo de producto insertado correctamente');
        }

        $this->showCreatePage();
    }

}