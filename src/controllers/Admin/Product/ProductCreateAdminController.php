<?php


namespace Juinsa\controllers\Admin\Product;

use Juinsa\db\entities\AttributeValue;
use Juinsa\db\entities\Product;
use Juinsa\db\entities\ProductAttributeValue;
use Juinsa\Services\ProductAttributeService;

class ProductCreateAdminController extends ProductAdminController
{

    /**
     * @Inject
     * @var ProductAttributeService
     */
    protected ProductAttributeService $productAttributeService;

    public function index()
    {
        $this->showCreateProductPage();
    }

    public function create()
    {
        $product = [];

        if (!$this->checkIfAllVarsAreValid()) {
            $this->exitAftersShowsCreateProductPage();
        }

        $product = new Product();

        $this->productProcessing($product);

        if (!$product) {
            $this->sessionManager->getFlashBag()->add('danger',
                "Ha ocurrido un error al intentar insertar el producto");
        } else {
            $this->sessionManager->getFlashBag()->add('success',
                "Producto añadido correctamente");
        }

        $this->showCreateProductPage();
    }

    /**
     * @param $postVars
     * @param Product $product
     */
    protected function buildAttributesValuesLines($postVars, Product &$product): void
    {
        foreach ($postVars['attributes'] as $id => $value) {
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

    /**
     * @param integer $idCategory
     * @param Product $product
     */
    protected function setCategoryToProduct($idCategory, Product &$product): void
    {
        $category = $this->categoryService->getCategory($idCategory);
        if (!$category) {
            $this->sessionManager->getFlashBag()->add('danger',
                'Error al localizar la categoría seleccionada');
            $this->exitAftersShowsCreateProductPage();
        }

        $product->setCategory($category);
    }

    /**
     * @param integer $idProductType
     * @param Product $product
     */
    protected function setProductTypeToProduct($idProductType, Product &$product): void
    {
        $productType = $this->productTypeService->getProductTypeById($idProductType);
        if (!$productType) {
            $this->sessionManager->getFlashBag()->add('danger',
                'Error al localizar el tipo de producto seleccionado');
            $this->exitAftersShowsCreateProductPage();
        }

        $product->setProductType($productType);
    }

    /**
     * @param $product
     */
    protected function productProcessing(&$product): void
    {
        $postVars = $_POST['product'];

        $product->setName($postVars['name']);

        $this->setCategoryToProduct((int)$postVars['category'], $product);

        $this->setProductTypeToProduct((int)$postVars['productType'], $product);

        $this->buildAttributesValuesLines($postVars, $product);
    }

}