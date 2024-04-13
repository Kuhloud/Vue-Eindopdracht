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
        $resanitizedUsernameInput = $this->userService->checkIfEmail($logindata->username);

        // get user from db
        $user = $this->userService->getUser(
            $resanitizedUsernameInput,
            $logindata->password
        );

        // if the method returned false, the username and/or password were incorrect
        if (!$user) {
            $this->respondWithError(401, "Invalid Username or password");
            return;
        }

        $this->generateJwt($user);

    }
    public function signup()
    {
        // read user data from request body
        $logindata = $this->createObjectFromPostedJson("Models\User");
        if (!$this->userService->isValidEmail($logindata->email)) {
            $this->respondWithError(400, "Email is not valid");
            return;
        }
        if (!$logindata->username || !$logindata->password) {
            $this->respondWithError(400, "Enter Username and/or password");
            return;
        }

        // get user from db
        $this->userService->insert(
            $logindata->username,
            $logindata->email,
            $logindata->password
        );

        $user = $this->userService->getUser(
            $logindata->username,
            $logindata->password
        );


        $this->generateJwt($user);
    }
    function generateJwt($user)
    {
        // generate jwt
        $key = $_ENV['JWT_GENERATED_KEY'];
        $payload = [
            'iss' => 'http://localhost:5173/',
            'aud' => 'http://localhost/',
            'sub' => $user->username,
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 3600
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');

        // return jwt
        $this->respond($jwt);

    }
}
