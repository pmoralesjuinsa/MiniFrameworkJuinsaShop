<?php


namespace Juinsa\controllers\Admin\Product;


class ProductCreateAdminController extends ProductAdminController
{

    public function index()
    {
        $categories = $this->categoryService->getCategories();
        $productTypes = $this->productTypeService->getProductTypes();

        $this->myRenderTemplate('admin/product/create.twig.html', ['categories' => $categories, 'productTypes' => $productTypes]);
    }

    public function create()
    {
        $product = [];
        var_dump($_POST);
        die();
        $this->myRenderTemplate('admin/product/create.twig.html', ['product' => $product]);
    }
}