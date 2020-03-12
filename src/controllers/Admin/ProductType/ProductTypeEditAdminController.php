<?php


namespace Juinsa\controllers\Admin\ProductType;


use Juinsa\db\entities\ProductType;
use Juinsa\db\entities\ProductTypeAttribute;

class ProductTypeEditAdminController extends ProductTypeAdminController
{
    /**
     * @param integer $id
     * @return void
     */
    public function edit($id): void
    {
        /**
         * @var ProductType $productType
         * @var ProductTypeAttribute $productAttribute
         */
        $productType = $this->productTypeService->getProductTypeById($id);

        if(!$productType) {
            $this->sessionManager->getFlashBag()->add('danger',
                'No se ha encontrado ningún tipo de producto con el id seleccionado');
        } else {
            foreach ($productType->getProductTypeAttributes() as $productAttribute) {
                $productTypeAttributes[$productAttribute->getProductAttribute()->getId()] = true;
            }
        }

        $this->showCreatePage($productType, $productTypeAttributes);
    }

    public function editSave($id)
    {
        if (!$this->checkIfAllVarsAreValid(true)) {
            $this->edit($id);
            die();
        }

        $postVars = $_POST['productType'];

        $productType = $this->productTypeService->getProductTypeById((int)$id);

        $productType->setName($postVars['name']);

        $this->buildProductTypeAttributeLinesEdit($postVars, $productType);

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

    /**
     * @param $postVars
     * @param ProductType $productType
     */
    protected function buildProductTypeAttributeLinesEdit($postVars, ProductType &$productType): void
    {
        /**
         * @var ProductTypeAttribute $productTypeAttribute
         */
        foreach ($productType->getProductTypeAttributes() as $productTypeAttribute) {
            $productAttributeId = $productTypeAttribute->getProductAttribute()->getId();

            if(!isset($postVars['attributes'][$productAttributeId])) {
                $productType->removeProductTypeAttributes($productTypeAttribute);
            } else {
                unset($postVars['attributes'][$productAttributeId]);
            }
        }

        $this->buildProductTypeAttributeLines($postVars, $productType);
    }
}