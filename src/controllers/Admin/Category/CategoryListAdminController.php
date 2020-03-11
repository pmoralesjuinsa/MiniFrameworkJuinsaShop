<?php


namespace Juinsa\controllers\Admin\Category;


class CategoryListAdminController extends CategoryAdminController
{
    public function index($categories = null)
    {
        if(is_null($categories)) {
            $categories = $this->categoryService->getCategories();
        }
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
        }

        $this->index($categories);
    }
}