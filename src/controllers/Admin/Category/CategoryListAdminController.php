<?php


namespace Juinsa\controllers\Admin\Category;


class CategoryListAdminController extends CategoryAdminController
{
    public function index()
    {
        $categories = $this->categoryService->getCategories();
        $this->myRenderTemplate('admin/category/list.twig.html', ['categories' => $categories]);
    }

    public function search()
    {
        $categories = [];
        if(isset($_POST['nameOrId']) && $_POST['nameOrId'] != '') {
            $nameOrId = $_POST['nameOrId'];
            if(is_numeric($_POST['nameOrId'])) {
                $categories = $this->categoryService->getCategoryAdminList((int)$nameOrId);
            } else {
                $categories = $this->categoryService->getCategoryAdminList(null, $nameOrId);
            }
        } else {
            $this->index();
            die();
        }

        $this->myRenderTemplate('admin/product/list.twig.html', ['categories' => $categories]);
    }
}