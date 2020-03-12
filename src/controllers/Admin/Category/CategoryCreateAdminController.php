<?php


namespace Juinsa\controllers\Admin\Category;


use Juinsa\db\entities\Category;

class CategoryCreateAdminController extends CategoryAdminController
{

    public function index()
    {
        $this->showCreatePage();
    }

    public function create()
    {
        $this->checkIfAllVarsAreValid();

        $category = new Category();

        $category->setName($_POST['name']);

        $this->categoryService->createCategory($category);

        if(!$category->getId()) {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar insertar la categoría');
        } else {
            $this->sessionManager->getFlashBag()->add('success', 'Categoría insertada correctamente');
        }

        $this->showCreatePage();
    }

}