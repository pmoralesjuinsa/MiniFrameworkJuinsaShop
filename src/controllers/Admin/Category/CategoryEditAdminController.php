<?php


namespace Juinsa\controllers\Admin\Category;


class CategoryEditAdminController extends CategoryAdminController
{
    /**
     * @param integer $id
     * @return void
     */
    public function edit($id): void
    {
        $category = $this->categoryService->getCategory($id);

        if(!$category) {
            $this->sessionManager->getFlashBag()->add('danger',
                'No se ha encontrado ninguna categoría con el id seleccionado');
        }

        $this->showCreatePage($category);
    }

    public function editSave()
    {
        $category = [];

        if (!$this->checkIfAllVarsAreValid(true)) {
            $this->exitAftersShowsCreatePage($this->entity);
        }

        $category = $this->categoryService->getCategory((int)$_POST['id']);

        $category->setName($_POST['name']);

        $this->categoryService->createCategory($category);

        if (!$category) {
            $this->sessionManager->getFlashBag()->add('danger',
                "Ha ocurrido un error al intentar editar la categoría");

            $this->showCreatePage($category);
        } else {
            $this->sessionManager->getFlashBag()->add('success',
                "Categoría editada correctamente");

            $this->redirectTo("/admin/categories");
        }
    }
}