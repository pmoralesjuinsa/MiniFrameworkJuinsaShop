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
}