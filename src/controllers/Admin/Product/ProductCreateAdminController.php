<?php


namespace Juinsa\controllers\Admin\Product;


class ProductCreateAdminController extends ProductAdminController
{

    public function index()
    {
        $this->showCreateProductPage();
    }

    public function create()
    {
        $product = [];

        $this->checkIfAllVarsAreValid();

        $postVars = $_POST['product'];

        $this->showCreateProductPage($product);
    }

    protected function checkIfAllVarsAreValid(): void
    {
        if (!isset($_POST['product'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'No has rellenado ningún dato del producto');
        } else {
            if (empty($_POST['product']['name'])) {
                $this->sessionManager->getFlashBag()->add('danger', 'El nombre no puede estar en blanco');
            }

            if (empty($_POST['product']['attributes'][7])) {
                $this->sessionManager->getFlashBag()->add('danger', 'El producto debe tener un precio');
            }
        }

        $this->showCreateProductPage();
        die();
    }

    protected function showCreateProductPage($product = null): void
    {
        $categories = $this->categoryService->getCategories();
        $productTypes = $this->productTypeService->getProductTypes();

        $this->myRenderTemplate('admin/product/create.twig.html',
            ['categories' => $categories, 'productTypes' => $productTypes, 'product' => $product]);
    }


}