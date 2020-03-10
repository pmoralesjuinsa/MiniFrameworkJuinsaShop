<?php


namespace Juinsa\controllers\Admin\Product;


use Juinsa\controllers\Admin\AdminController;
use Juinsa\Services\ProductAttributeService;

class ProductAjaxAdminController extends AdminController
{
    /**
     * @Inject
     * @var ProductAttributeService
     */
    protected ProductAttributeService $attributeService;

    public function index()
    {

    }

    /**
     * @return void
     */
    public function getAttributes(): void
    {
        $attributesContainer = $attributes = [];

        if (!isset($_POST['productType'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'No se ha elegido ningún tipo de producto');
        } else {
            $idProductType = (int)$_POST['productType'];

            if (empty($idProductType) || $idProductType <= 0) {
                $this->sessionManager->getFlashBag()->add('danger', 'No se ha elegido un tipo de producto válido');
            } else {
                $attributes = $this->attributeService->getAttributesByProductTypeId($idProductType);

                if(!$attributes) {
                    $this->sessionManager->getFlashBag()->add('warning', 'Éste tipo de producto no tiene atributos asociados');
                }
            }
        }

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