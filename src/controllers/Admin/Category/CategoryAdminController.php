<?php


namespace Juinsa\controllers\Admin\Category;


use Juinsa\controllers\Admin\AdminController;
use Juinsa\Services\CategoryService;

class CategoryAdminController extends AdminController
{
    /**
     * @Inject
     * @var CategoryService
     */
    protected CategoryService $categoryService;


}