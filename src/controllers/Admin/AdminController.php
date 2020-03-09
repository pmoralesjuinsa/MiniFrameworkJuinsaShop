<?php


namespace Juinsa\controllers\Admin;

use Juinsa\controllers\Controller;
use DI\Annotation\Inject;

class AdminController extends Controller
{
//    /**
//     * @Inject
//     * @var UserService
//     */
//    protected UserService $userService;

    public function index()
    {
        $this->redirectIfNotLoguedAsUser();

        $this->myRenderTemplate('user/admin.twig.html');
    }
}