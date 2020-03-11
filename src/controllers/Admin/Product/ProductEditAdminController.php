<?php


namespace Juinsa\controllers\Admin\Product;


class ProductEditAdminController extends ProductAdminController
{
    public function index()
    {

    }

    /**
     * @param integer $id
     * @return void
     */
    public function edit($id): void
    {
        $product = $this->productService->getProduct($id);

        if(!$product) {
            $this->sessionManager->getFlashBag()->add('danger',
                'No se ha encontrado ningún producto con el id seleccionado');
        }

        $this->showCreateProductPage($product);
    }

    public function editSave()
    {
        $product = [];

        if (!$this->checkIfAllVarsAreValid(true)) {
            $this->exitAftersShowsCreateProductPage();
        }

        $product = $this->productService->getProduct((int)$_POST['product']['id']);

        $this->editProductProcessing($product);

        if (!$product) {
            $this->sessionManager->getFlashBag()->add('danger',
                "Ha ocurrido un error al intentar editar el producto");

            $this->showCreateProductPage($product);
        } else {
            $this->sessionManager->getFlashBag()->add('success',
                "Producto editado correctamente");

            $this->redirectTo("/admin/products");
        }
    }

    /**
     * @param $product
     */
    protected function editProductProcessing(&$product): void
    {
        $postVars = $_POST['product'];

        $product->setName($postVars['name']);

        $this->setCategoryToProduct((int)$postVars['category'], $product);

        $this->setProductTypeToProduct((int)$postVars['productType'], $product);

        $this->buildAttributesValuesLines($postVars, $product);
    }

    /**
     * @param $postVars
     * @param Product $product
     */
    protected function editBuildAttributesValuesLines($postVars, Product &$product): void
    {
        foreach ($product->attributeValues as $id => $value) {
            if (!empty($value)) {
                $productAttributeEntity = $this->productAttributeService->getProductAttributebyId((int)$id);

                $productAttributeValue = new ProductAttributeValue();
                $productAttributeValue->setAttributes($productAttributeEntity);
                $productAttributeValue->setValue($value);

                $attributeValue = new AttributeValue();
                $attributeValue->setProduct($product);
                $attributeValue->setAttributeValue($productAttributeValue);
                $attributeValue->setProductAttribute($productAttributeEntity);

                $product->addAttributeValues($attributeValue);
            }
        }

        $product = $this->productService->createProduct($product);
    }
}