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

        if ($this->checkIfAllVarsAreValid()) {
            $postVars = $_POST['product'];

            $product = new Product();
            $product->setName($postVars['name']);
            $product->setCategory($postVars['category']);
            $product->setProductType($postVars['productType']);

            foreach ($postVars['attributes'] as $id => $value) {
                if (!empty($value)) {
                    $productAttributeEntity = $this->productAttributeService->getProductAttributebyId($id);

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

            $this->productService->createProduct($product);
        }

        $this->showCreateProductPage();
    }

    /**
     * @return bool
     */
    protected function checkIfAllVarsAreValid(): bool
    {
        if (!isset($_POST['product'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'No has rellenado ningún dato del producto');
            return false;
        } else {
            $postVars = $_POST['product'];
            if (empty($postVars['name'])) {
                $this->sessionManager->getFlashBag()->add('danger', 'El nombre no puede estar en blanco');
                return false;
            }

            if (empty($postVars['category'])) {
                $this->sessionManager->getFlashBag()->add('danger', 'Debes elegir una categoría');
                return false;
            }

            if (empty($postVars['productType'])) {
                $this->sessionManager->getFlashBag()->add('danger', 'Debes elegir un tipo de producto');
                return false;
            }

            if (empty($postVars['attributes'][7])) {
                $this->sessionManager->getFlashBag()->add('danger', 'El producto debe tener un precio');
                return false;
            }
        }

        return true;
    }

    protected function showCreateProductPage($product = null): void
    {
        $categories = $this->categoryService->getCategories();
        $productTypes = $this->productTypeService->getProductTypes();

        $this->myRenderTemplate('admin/product/create.twig.html',
            ['categories' => $categories, 'productTypes' => $productTypes, 'product' => $product]);
    }


}