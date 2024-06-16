<?php
namespace Services;

use Repositories\UserRoleRepository;

class UserRoleService {

    private $repository;

    function __construct()
    {
        $this->repository = new UserRoleRepository();
    }

    public function getRoleById($user_id) {
        return $this->repository->getRoleById($user_id);
    }
    public function deletePost($user_id, $role_id) {
        return $this->repository->insert($user_id, $role_id);
    }
}
