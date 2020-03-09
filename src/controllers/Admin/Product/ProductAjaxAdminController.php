<?php


namespace Juinsa\controllers\Admin\Product;


use Juinsa\controllers\Admin\AdminController;

class ProductAjaxAdminController extends AdminController
{
    public function index()
    {

    }

    /**
     * @return void
     */
    public function getAttributes(): void
    {
        $attributes = ['id' => 7, 'name' => 'price'];

        echo json_encode($attributes);
    }
}