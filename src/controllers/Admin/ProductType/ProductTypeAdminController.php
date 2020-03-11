<?php


namespace Juinsa\controllers\Admin\ProductType;


use Juinsa\controllers\Admin\AdminController;
use Juinsa\db\entities\ProductType;
use Juinsa\Services\ProductTypeService;

class ProductTypeAdminController extends AdminController
{
    /**
     * @Inject
     * @var ProductTypeService
     */
    protected ProductTypeService $productTypeService;

    /**
     * @param ProductType|null $productType
     */
    protected function showCreatePage($productType = null)
    {
        $this->myRenderTemplate('admin/producttype/create.twig.html', ['productType' => $productType]);
    }

    /**
     * @param bool $checkId
     * @return bool
     */
    protected function checkIfAllVarsAreValid($checkId = false): bool
    {
        if($checkId) {
            if(!isset($_POST['id']) || !is_numeric($_POST['id'])) {
                $this->sessionManager->getFlashBag()->add('danger', 'No hay un id válido');
                return false;
            }
        }

        if (empty($_POST['name'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'El nombre no puede estar en blanco');
            return false;
        }

        return true;
    }
}