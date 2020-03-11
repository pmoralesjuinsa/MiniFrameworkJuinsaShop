<?php


namespace Juinsa\controllers\Admin\Product;

use Juinsa\Services\ProductAttributeService;

class ProductAjaxAdminController extends ProductAdminController
{

    public function index()
    {

    }

    /**
     * @return void
     */
    public function getAttributes(): void
    {
        $attributesContainer = $attributes = $productAttributes = [];

        if (!isset($_POST['productType'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'No se ha elegido ningún tipo de producto');
        } else {
            $idProductType = (int)$_POST['productType'];

            if (empty($idProductType) || $idProductType <= 0) {
                $this->sessionManager->getFlashBag()->add('danger', 'No se ha elegido un tipo de producto válido');
            } else {
                $attributes = $this->productAttributeService->getAttributesByProductTypeId($idProductType);

                if(!$attributes) {
                    $this->sessionManager->getFlashBag()->add('warning', 'Éste tipo de producto no tiene atributos asociados');
                }
            }
        }

        $this->setProductAttributesIfWeAreEditing($productAttributes);

        $this->renderMessagesToAjax($attributesContainer);

        $this->renderAttributesForAjax($productAttributes, $attributes, $attributesContainer);

        echo json_encode($attributesContainer);
    }

    /**
     * @param array $productAttributes
     * @param array $attributes
     * @param array $attributesContainer
     */
    protected function renderAttributesForAjax(array $productAttributes, array $attributes, array &$attributesContainer): void
    {
        ob_start();
        $this->myRenderTemplate('admin/product/ajax_attributes.twig.html', ['attributes' => $attributes, 'productAttributes' => $productAttributes]);
        $attributesContainer['html'] = ob_get_clean();
    }

    /**
     * @param array $productAttributes
     */
    protected function setProductAttributesIfWeAreEditing(array &$productAttributes): void
    {
        if (!isset($_POST['productId']) || !is_numeric($_POST['productId'])) {
            return;
        }

        $product = $this->productService->getProduct((int)$_POST['productId']);

        if (!$product) {
            $this->sessionManager->getFlashBag()->add('danger',
                'Error al buscar los atributos del producto');
        }

        foreach ($product->attributeValues as $attributeValue) {
            $productAttributes[$attributeValue->productAttribute->getId()] = $attributeValue->attributeValue->getValue();
        }
    }


}