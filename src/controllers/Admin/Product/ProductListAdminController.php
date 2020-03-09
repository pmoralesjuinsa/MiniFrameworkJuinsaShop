<?php


namespace Juinsa\controllers\Admin\Product;


class ProductListAdminController extends ProductAdminController
{
    public function index()
    {
        $this->myRenderTemplate('admin/product/list.twig.html');
    }
}