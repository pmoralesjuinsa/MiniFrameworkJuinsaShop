<?php


namespace Juinsa\controllers\Admin\Product;


class ProductListAdminController extends ProductAdminController
{
    public function index()
    {
        $products = $this->productService->getProductAdminList();
        $this->myRenderTemplate('admin/product/list.twig.html', ['products' => $products]);
    }

    public function search()
    {
        $products = [];
        if(isset($_POST['nameOrId']) && $_POST['nameOrId'] != '') {
            $nameOrId = $_POST['nameOrId'];
            if(is_numeric($_POST['nameOrId'])) {
                $products = $this->productService->getProductAdminList((int)$nameOrId);
            } else {
                $products = $this->productService->getProductAdminList(null, $nameOrId);
            }
        } else {
            $this->index();
            die();
        }

        $this->myRenderTemplate('admin/product/list.twig.html', ['products' => $products]);
    }
}