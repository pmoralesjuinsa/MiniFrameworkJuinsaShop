<?php


namespace Juinsa\controllers\Admin\ProductType;


use Juinsa\controllers\Admin\AdminController;
use Juinsa\db\entities\ProductType;
use Juinsa\Services\ProductAttributeService;
use Juinsa\Services\ProductTypeService;

class ProductTypeAdminController extends AdminController
{
    /**
     * @Inject
     * @var ProductTypeService
     */
    protected ProductTypeService $productTypeService;

    /**
     * @Inject
     * @var ProductAttributeService
     */
    protected ProductAttributeService $productAttributeService;

    /**
     * @param ProductType|null $productType
     * @param array|null $productTypeAttributes
     */
    protected function showCreatePage($productType = null, $productTypeAttributes = null)
    {
        $productAttributes = $this->productAttributeService->getProductAttributes();

        $this->myRenderTemplate('admin/producttype/create.twig.html', [
            'productType' => $productType,
            'productAttributes' => $productAttributes,
            'productTypeAttributes' => $productTypeAttributes
        ]);
    }

    /**
     * @param bool $checkId
     * @return bool
     */
    protected function checkIfAllVarsAreValid($checkId = false): bool
    {
        if (!isset($_POST['productType'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'Datos no rellenados');
            return false;
        }

        $postVars = $_POST['productType'];
        if ($checkId) {
            if (!isset($postVars['id']) || !is_numeric($postVars['id'])) {
                $this->sessionManager->getFlashBag()->add('danger', 'No hay un id válido');
                return false;
            }
        }

        if (empty($postVars['name'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'El nombre no puede estar en blanco');
            return false;
        }

        if (empty($postVars['attributes'][7])) {
            $this->sessionManager->getFlashBag()->add('danger', 'Todos los tipos de producto deben tener un precio');
            return false;
        }

        return true;
    }
}