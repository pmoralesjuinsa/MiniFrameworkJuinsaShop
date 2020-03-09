<?php


namespace Juinsa\controllers\Admin\Product;


use Juinsa\controllers\Admin\AdminController;
use Juinsa\Services\ProductService;

class ProductAdminController extends AdminController
{
    /**
     * @Inject
     * @var ProductService
     */
    protected ProductService $productService;

    public function index()
    {

    }
}