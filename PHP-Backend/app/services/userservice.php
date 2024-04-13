<?php
namespace Services;

use Repositories\UserRepository;

class UserService {

    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function getUser($username, $password) {
        return $this->repository->getUser($username, $password);
    }
    public function insert($username, $email, $plainPassword) {
        
        $repository = new UserRepository();
        if ($repository->isExistingUsername($username) || $repository->isExistingEmail($email)) {
            return false;
        }
        $hashedPassword = $this->hashPassword($plainPassword);
        $repository->insert($username, $email, $hashedPassword);       
    }
    // hash the password (currently uses bcrypt)
    function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public function checkIfEmail($usernameData) {
        $sanitizedUsername = filter_var($usernameData, FILTER_SANITIZE_EMAIL);
        if (filter_var($usernameData, FILTER_VALIDATE_EMAIL)) {
            return $sanitizedUsername;
        }
        return filter_var($usernameData, FILTER_SANITIZE_STRING);
    }
    public function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    // // verify the password hash
    // function verifyPassword($input, $user)
    // {
    //     $result = password_verify($input, $user->password);
    //     if (!$result) {
    //         return false;
    //     }
    //     // do not pass the password hash to the caller
    //     $user->password = "";
    //     return $user;
    // }
}
