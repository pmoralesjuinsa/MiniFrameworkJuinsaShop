<?php


namespace Juinsa\controllers\Admin;

use Juinsa\controllers\Controller;
use DI\Annotation\Inject;
use Juinsa\ViewManager;

class AdminController extends Controller
{

    protected $adminMenu;

    public function index()
    {
        $this->redirectIfNotLoguedAsUser();

        $this->myRenderTemplate('admin/admin.twig.html');
    }
}