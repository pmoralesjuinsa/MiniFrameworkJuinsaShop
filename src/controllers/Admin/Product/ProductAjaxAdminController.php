<?php


namespace Juinsa\controllers\Admin\Product;


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
        $attributes = [];

        echo json_encode($attributes);
    }
}