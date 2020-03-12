<?php


namespace Juinsa\controllers\Admin\User;


class UserListAdminController extends UserAdminController
{
    public function index($users = null)
    {
        if(is_null($users)) {
            $users = $this->userService->getUsers();
        }
        $this->myRenderTemplate('admin/user/list.twig.html', ['users' => $users]);
    }

    public function search()
    {
        $users = [];
        if(isset($_POST['nameOrId']) && $_POST['nameOrId'] != '') {
            $nameOrId = $_POST['nameOrId'];
            if(is_numeric($_POST['nameOrId'])) {
                $users = $this->userService->getUserAdminList((int)$nameOrId);
            } else {
                $users = $this->userService->getUserAdminList(null, $nameOrId);
            }
        }

        $this->index($users);
    }
}