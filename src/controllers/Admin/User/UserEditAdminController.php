<?php


namespace Juinsa\controllers\Admin\User;


class UserEditAdminController extends UserAdminController
{
    /**
     * @param integer $id
     * @return void
     */
    public function edit($id): void
    {
        $user = $this->userService->getUserById($id);

        if(!$user) {
            $this->sessionManager->getFlashBag()->add('danger',
                'No se ha encontrado ningún usuario con el id seleccionado');
        }

        $this->showCreatePage($user);
    }

    public function editSave($id)
    {
        if (!$this->checkIfAllVarsAreValid(true)) {
            $this->edit($id);
            die();
        }

        $user = $this->userService->getUserById((int)$id);

        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        if(!empty($_POST['password'])) {
            $user->setPassword(sha1($_POST['password']));
        }

        $this->userService->createUser($user);

        if (!$user) {
            $this->sessionManager->getFlashBag()->add('danger',
                "Ha ocurrido un error al intentar editar el usuario");

            $this->showCreatePage($user);
        } else {
            $this->sessionManager->getFlashBag()->add('success',
                "Usuario editado correctamente");

            $this->redirectTo("/admin/user/list");
        }
    }
}