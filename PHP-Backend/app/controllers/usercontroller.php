<?php

namespace Controllers;

use Firebase\JWT\JWT;
use Services\UserService;

class UserController extends Controller
{
    private $userService;

    // initialize services
    function __construct()
    {
        $this->userService = new UserService();
    }

    public function login()
    {

        // read user data from request body
        $logindata = $this->createObjectFromPostedJson("Models\User");
        $resanitizedUsernameInput = $this->userService->checkIfEmail($logindata->getUsername());

        // get user from db
        $user = $this->userService->getUser(
            $resanitizedUsernameInput,
            $logindata->getPassword()
        );

        // if the method returned false, the username and/or password were incorrect
        if (!$user) {
            $this->respondWithError(401, "Invalid Username or password");
            return;
        }

        $jwt = $this->generateJwt($user);

        $this->respond([
            "token" => $jwt,
            "user" => $user
        ]);

    }
    public function signup()
    {
        // read user data from request body
        $logindata = $this->createObjectFromPostedJson("Models\User");
        if (!$this->userService->isValidEmail($logindata->getEmail())) {
            $this->respondWithError(400, "Email is not valid");
            return;
        }
        if (!$logindata->getUsername() || !$logindata->getPassword()) {
            $this->respondWithError(400, "Enter Username and/or password");
            return;
        }

        // get user from db
        $this->userService->insert(
            $logindata->getUsername(),
            $logindata->getEmail(),
            $logindata->getPassword()
        );

        $user = $this->userService->getUser(
            $logindata->getUsername(),
            $logindata->getPassword()
        );
        $jwt = $this->generateJwt($user);

        $this->respond([
            "token" => $jwt,
            "user" => $user
        ]);
    }
    function generateJwt($user)
    {
        // generate jwt
        $key = $_ENV['JWT_GENERATED_KEY'];
        $payload = [
            'iss' => 'http://localhost:5173/',
            'aud' => 'http://localhost/',
            'sub' => $user->getUsername(),
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 3600
        ];
        return $jwt = JWT::encode($payload, $key, 'HS256');

        // return jwt

    }
    function getUserById($user_id)
    {
        $user = $this->userService->getUserById($user_id);
        if (!$user) {
            $this->respondWithError(404, "User not found");
            return;
        }
        $this->respond($user);
    }
}
