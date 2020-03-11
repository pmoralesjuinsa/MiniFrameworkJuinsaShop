<?php


namespace Juinsa\controllers\Admin\Category;


use Juinsa\db\entities\Category;

class CategoryCreateAdminController extends CategoryAdminController
{

    public function index()
    {
        $this->myRenderTemplate('admin/category/create.twig.html');
    }

    /**
     * @param Category|null $category
     */
    public function create()
    {
        if(empty($_POST['name'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'El nombre no puede estar en blanco');
            $this->myRenderTemplate('admin/category/create.twig.html');
            die();
        }

        $category = new Category();

        $category->setName($_POST['name']);

        $this->categoryService->createCategory($category);

        if(!$category->getId()) {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar insertar la categoría');
        } else {
            $this->sessionManager->getFlashBag()->add('success', 'Categoría insertada correctamente');
        }

        $this->myRenderTemplate('admin/category/create.twig.html', ['category' => $category]);
    }
}