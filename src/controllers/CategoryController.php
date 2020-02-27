<?php


namespace Juinsa\controllers;

use Juinsa\Services\CategoryService;

class CategoryController extends Controller
{

    /**
     * @Inject
     * @var CategoryService
     */
    private CategoryService $categoryService;

    public function index()
    {

    }

    public function showCategoryInfo($id, $name)
    {
        $category = $this->categoryService->getCategory($id);

        $this->myRenderTemplate("index.twig.html", ["category" => $category]);
    }

}