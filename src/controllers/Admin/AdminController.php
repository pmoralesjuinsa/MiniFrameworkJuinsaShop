<?php


namespace Juinsa\controllers\Admin;

use Juinsa\controllers\Controller;
use Juinsa\SessionManager;
use Juinsa\ViewManager;

class AdminController extends Controller
{

    public function __construct(ViewManager $viewManager, SessionManager $sessionManager)
    {
        parent::__construct($viewManager, $sessionManager);

        $this->redirectIfNotLoguedAsUser();
    }

    public function index()
    {
        $this->myRenderTemplate('admin/admin.twig.html');
    }

}