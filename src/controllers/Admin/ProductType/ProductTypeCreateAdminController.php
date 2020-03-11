<?php


namespace Juinsa\controllers\Admin\ProductType;


use Juinsa\db\entities\ProductType;

class ProductTypeCreateAdminController extends ProductTypeAdminController
{

    public function index()
    {
        $this->showCreatePage();
    }


    public function create()
    {
        $this->checkIfAllVarsAreValid();

        $productType = new ProductType();

        $productType->setName($_POST['name']);

        $this->productTypeService->createProductType($productType);

        if(!$productType->getId()) {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar insertar el tipo de producto');
        } else {
            $this->sessionManager->getFlashBag()->add('success', 'Tipo de producto insertado correctamente');
        }

        $this->showCreatePage();
    }

}