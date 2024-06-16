<?php

namespace Controllers;

use Services\UserRoleService;

class UserRoleController extends Controller
{
    private $userRoleService;

    // initialize services
    function __construct()
    {
        $this->userRoleService = new UserRoleService();
    }
    public function getRoleById($user_id)
    {
        $role_name = $this->userRoleService->getRoleById($user_id);

        $this->respond($role_name);
    }
}
