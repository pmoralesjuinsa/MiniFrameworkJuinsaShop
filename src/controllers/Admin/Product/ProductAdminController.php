<?php


namespace Juinsa\controllers\Admin\Product;


use Juinsa\controllers\Admin\AdminController;
use Juinsa\Services\CategoryService;
use Juinsa\Services\ProductAttributeService;
use Juinsa\Services\ProductService;
use Juinsa\Services\ProductTypeService;

class ProductAdminController extends AdminController
{
    /**
     * @Inject
     * @var ProductService
     */
    protected ProductService $productService;

    /**
     * @Inject
     * @var CategoryService
     */
    protected CategoryService $categoryService;

    /**
     * @Inject
     * @var ProductTypeService
     */
    protected ProductTypeService $productTypeService;

    /**
     * @Inject
     * @var ProductAttributeService
     */
    protected ProductAttributeService $productAttributeService;

    public function index()
    {

    }

    protected function showCreateProductPage($product = null): void
    {
        $categories = $this->categoryService->getCategories();
        $productTypes = $this->productTypeService->getProductTypes();

        $this->myRenderTemplate('admin/product/create.twig.html',
            ['categories' => $categories, 'productTypes' => $productTypes, 'product' => $product]);
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
     * @return bool
     */
    protected function checkIfAllVarsAreValid($checkId = false): bool
    {
        //TODO hacer un método más fiable de comprobar los valores
        //TODO aplicar también chain responsability
        if (!isset($_POST['product'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'No has rellenado ningún dato del producto');
            return false;
        }

        $postVars = $_POST['product'];

        if($checkId) {
            if (empty($postVars['id']) || !is_numeric($postVars['id'])) {
                $this->sessionManager->getFlashBag()->add('danger', 'El producto no es válido');
                return false;
            }
        }

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
}