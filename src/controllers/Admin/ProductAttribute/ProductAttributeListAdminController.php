<?php


namespace Juinsa\controllers\Admin\ProductAttribute;


class ProductAttributeListAdminController extends ProductAttributeAdminController
{
    public function index($productAttributes = null)
    {
        if(is_null($productAttributes)) {
            $productAttributes = $this->productAttributeService->getProductAttributes();
        }
        $this->myRenderTemplate('admin/productattribute/list.twig.html', ['productAttributes' => $productAttributes]);
    }

    public function search()
    {
        $productAttributes = [];
        if(isset($_POST['nameOrId']) && $_POST['nameOrId'] != '') {
            $nameOrId = $_POST['nameOrId'];
            if(is_numeric($_POST['nameOrId'])) {
                $productAttributes = $this->productAttributeService->getProductAttributeAdminList((int)$nameOrId);
            } else {
                $productAttributes = $this->productAttributeService->getProductAttributeAdminList(null, $nameOrId);
            }
        }

        $this->index($productAttributes);
    }
}