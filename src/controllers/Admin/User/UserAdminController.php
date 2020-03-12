<?php


namespace Juinsa\controllers\Admin\User;


use Juinsa\controllers\Admin\AdminController;
use Juinsa\db\entities\User;
use Juinsa\Services\UserService;

class UserAdminController extends AdminController
{
    /**
     * @Inject
     * @var UserService
     */
    protected UserService $userService;

    /**
     * @param User|null $user
     */
    protected function showCreatePage($user = null)
    {
        $this->myRenderTemplate('admin/user/create.twig.html', ['user' => $user]);
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