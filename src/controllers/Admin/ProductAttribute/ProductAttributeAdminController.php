<?php


namespace Juinsa\controllers\Admin\ProductAttribute;


use Juinsa\controllers\Admin\AdminController;
use Juinsa\db\entities\ProductAttribute;
use Juinsa\Services\ProductAttributeService;

class ProductAttributeAdminController extends AdminController
{
    /**
     * @Inject
     * @var ProductAttributeService
     */
    protected ProductAttributeService $productAttributeService;

    /**
     * @param ProductAttribute|null $productAttribute
     */
    protected function showCreatePage($productAttribute = null)
    {
        $this->myRenderTemplate('admin/productattribute/create.twig.html', ['productAttribute' => $productAttribute]);
    }

    /**
     * @return void
     */
    protected function exitAftersShowsCreatePage(): void
    {
        $this->showCreatePage();
        die();
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