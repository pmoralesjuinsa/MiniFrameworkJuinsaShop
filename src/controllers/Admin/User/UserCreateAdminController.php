<?php


namespace Juinsa\controllers\Admin\User;



use Juinsa\db\entities\User;

class UserCreateAdminController extends UserAdminController
{

    public function index()
    {
        $this->showCreatePage();
    }

    public function create()
    {
        $this->checkIfAllVarsAreValid();

        $user = new User();

        $user->setName($_POST['name']);

        $this->userService->createUser($user);

        if(!$user->getId()) {
            $this->sessionManager->getFlashBag()->add('danger', 'Error al intentar insertar el usuario');
        } else {
            $this->sessionManager->getFlashBag()->add('success', 'Usuario insertado correctamente');
        }

        $this->showCreatePage();
    }

}