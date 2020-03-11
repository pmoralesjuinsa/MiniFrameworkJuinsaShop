<?php


namespace Juinsa\controllers\Admin\ProductType;


class ProductTypeListAdminController extends ProductTypeAdminController
{
    public function index($productTypes = null)
    {
        if(is_null($productTypes)) {
            $productTypes = $this->productTypeService->getProductTypes();
        }
        $this->myRenderTemplate('admin/producttype/list.twig.html', ['$productTypes' => $productTypes]);
    }

    public function search()
    {
        $productTypes = [];
        if(isset($_POST['nameOrId']) && $_POST['nameOrId'] != '') {
            $nameOrId = $_POST['nameOrId'];
            if(is_numeric($_POST['nameOrId'])) {
                $productTypes = $this->categoryService->getCategoryAdminList((int)$nameOrId);
            } else {
                $productTypes = $this->categoryService->getCategoryAdminList(null, $nameOrId);
            }
        }

        $this->index($productTypes);
    }
}