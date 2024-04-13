<?php
namespace Services;

use Repositories\UserRepository;

class UserService {

    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function checkUsernamePassword($username, $password) {
        return $this->repository->checkUsernamePassword($username, $password);
    }
    public function checkIfEmail($usernameData) {
        $sanitizedUsername = filter_var($usernameData, FILTER_SANITIZE_EMAIL);
        if (filter_var($usernameData, FILTER_VALIDATE_EMAIL)) {
            return $sanitizedUsername;
        }
        return filter_var($usernameData, FILTER_SANITIZE_STRING);
    }
}
