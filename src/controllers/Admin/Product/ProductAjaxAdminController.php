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
        $attributesContainer = [];
        $attributes = [ 0 => ['id' => 7, 'name' => 'price']];
        $this->sessionManager->getFlashBag()->add('danger', 'peligrooo');

        $this->renderMessagesToAjax($attributesContainer);

        $this->renderAttributesForAjax($attributes, $attributesContainer);

        echo json_encode($attributesContainer);
    }

    /**
     * @param array $attributes
     * @param array $attributesContainer
     */
    protected function renderAttributesForAjax(array $attributes, array &$attributesContainer): void
    {
        ob_start();
        $this->myRenderTemplate('admin/product/ajax_attributes.twig.html', ['attributes' => $attributes]);
        $attributesContainer['html'] = ob_get_clean();
    }


}