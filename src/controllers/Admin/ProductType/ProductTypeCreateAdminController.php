<?php


namespace Juinsa\controllers\Admin\ProductType;


use Juinsa\db\entities\ProductType;
use Juinsa\db\entities\ProductTypeAttribute;

class ProductTypeCreateAdminController extends ProductTypeAdminController
{

    public function index()
    {
        $this->showCreatePage();
    }


    public function create()
    {
        $this->checkIfAllVarsAreValid();

        $postVars = $_POST['productType'];

        $productType = new ProductType();

        $productType->setName($postVars['name']);

        $this->buildProductTypeAttributeLines($postVars, $productType);

        $this->productTypeService->createProductType($productType);

        if(!$productType->getId()) {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar insertar el tipo de producto');
        } else {
            $this->sessionManager->getFlashBag()->add('success', 'Tipo de producto insertado correctamente');
        }

        $this->showCreatePage();
    }

    /**
     * @param $postVars
     * @param ProductType $productType
     */
    protected function buildProductTypeAttributeLines($postVars, ProductType &$productType): void
    {
        foreach ($postVars['attributes'] as $id => $name) {
            $productAttributeEntity = $this->productAttributeService->getProductAttributebyId((int)$id);

            $productTypeAttribute = new ProductTypeAttribute();
            $productTypeAttribute->setProductAttribute($productAttributeEntity);
            $productTypeAttribute->setProductType($productType);

            $productType->addProductTypeAttributes($productTypeAttribute);
        }

        $productType = $this->productTypeService->createProductType($productType);
    }

}