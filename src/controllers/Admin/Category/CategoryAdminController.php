<?php


namespace Juinsa\controllers\Admin\Category;


use Juinsa\controllers\Admin\AdminController;
use Juinsa\db\entities\Category;
use Juinsa\Services\CategoryService;

class CategoryAdminController extends AdminController
{
    /**
     * @Inject
     * @var CategoryService
     */
    protected CategoryService $categoryService;

    protected $entity = "category";

    /**
     * @param Category|null $category
     */
    protected function showCreatePage($category = null)
    {
        $this->myRenderTemplate('admin/category/create.twig.html', ['category' => $category]);
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