<?php


namespace Juinsa\controllers;

use Juinsa\Services\CategoryService;
use Juinsa\Services\ProductService;

class CategoryController extends Controller
{

    /**
     * @Inject
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * @Inject
     * @var ProductService
     */
    private ProductService $productService;

    public function index()
    {

    }

    public function showCategoryInfo($id, $name)
    {
        $category = $this->categoryService->getCategory($id);

        if(!$category->id) {
            $this->sessionManager->getFlashBag()->add("error", "No se ha encontrado la categoría");
            return;
        }

        $products = $this->productService->getCategoryProducts($category->id);

        $this->myRenderTemplate("category.twig.html", ["category" => $category, "products" => $products]);
    }

}