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
        \Kint::dump($category);

        $this->viewManager->renderTemplate("index.twig.html", ["category" => $category]);
    }

}