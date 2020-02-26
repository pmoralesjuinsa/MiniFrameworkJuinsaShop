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
        $id = (int)$_GET['id'];
        var_dump($this->id);

        $category = $this->categoryService->getCategory($id);

        $this->viewManager->renderTemplate("index.twig.html", ["category" => $category]);
    }

}