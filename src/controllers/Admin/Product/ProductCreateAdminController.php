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

        $postVars = $_POST['product'];

        $product = new Product();
        $product->setName($postVars['name']);

        $this->setCategoryToProduct((int)$postVars['category'], $product);

        $this->setProductTypeToProduct((int)$postVars['productType'], $product);

        $this->buildAttributesValuesLines($postVars, $product);

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
     * @return bool
     */
    protected function checkIfAllVarsAreValid(): bool
    {
        //TODO hacer un método más fiable de comprobar los valores
        //TODO aplicar también chain responsability
        if (!isset($_POST['product'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'No has rellenado ningún dato del producto');
            return false;
        }

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

        return true;
    }


    protected function showCreateProductPage($product = null): void
    {
        $categories = $this->categoryService->getCategories();
        $productTypes = $this->productTypeService->getProductTypes();

        $this->myRenderTemplate('admin/product/create.twig.html',
            ['categories' => $categories, 'productTypes' => $productTypes, 'product' => $product]);
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
     * @param integer $id
     * @return void
     */
    public function edit($id): void
    {
        $product = $this->productService->getProduct($id);

        if(!$product) {
            $this->sessionManager->getFlashBag()->add('danger', 'No se ha encontrado ningún producto con el id seleccionado');
        }

        $this->showCreateProductPage($product);
    }

    /**
     * @return void
     */
    protected function exitAftersShowsCreateProductPage(): void
    {
        $this->showCreateProductPage();
        die();
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

}