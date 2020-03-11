<?php


namespace Juinsa\controllers\Admin\Product;


use Juinsa\db\entities\Product;

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

    public function editSave($id)
    {
        if (!$this->checkIfAllVarsAreValid(true)) {
            $this->edit($id);
            die();
        }

        $product = $this->productService->getProduct((int)$id);

        $this->productProcessingEdit($product);

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
     * @param Product $product
     */
    protected function productProcessingEdit(&$product): void
    {
        $postVars = $_POST['product'];

        $product->setName($postVars['name']);

        $this->setCategoryToProduct((int)$postVars['category'], $product);

        $this->setProductTypeToProduct((int)$postVars['productType'], $product);

        $this->buildAttributesValuesLinesEdit($postVars, $product);
    }

    /**
     * @param $postVars
     * @param Product $product
     */
    protected function buildAttributesValuesLinesEdit($postVars, Product &$product): void
    {
        foreach ($product->getAttributeValues() as $attributeValue) {
            $productAttributeId = $attributeValue->getProductAttribute()->getId();

            $attributeValue->getAttributeValue()->setValue($postVars['attributes'][$productAttributeId]);
        }

        $product = $this->productService->createProduct($product);
    }
}