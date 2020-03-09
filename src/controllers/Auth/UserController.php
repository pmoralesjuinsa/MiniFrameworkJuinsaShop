<?php


namespace Juinsa\controllers\Auth;

use Juinsa\controllers\Controller;
use DI\Annotation\Inject;
use Juinsa\Services\UserService;

class UserController extends Controller
{
    /**
     * @Inject
     * @var UserService
     */
    protected UserService $userService;

    public function index()
    {

    }
}