<?php

declare(strict_types=1);

namespace Juinsa\controllers;

use DI\Annotation\Inject;
use Juinsa\Services\CategoryService;

class HomeController extends Controller
{

    /**
     * @Inject
     * @var CategoryService
     */
    private CategoryService $categoryService;

    public function index()
    {
        $categories = $this->categoryService->getCategories();

        $this->myRenderTemplate("index.twig.html", ["categories" => $categories]);
    }
}