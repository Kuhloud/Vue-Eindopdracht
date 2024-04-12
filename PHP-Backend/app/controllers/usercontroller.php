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

    public function login() {

        // read user data from request body
        $logindata = $this->createObjectFromPostedJson("Models\User");

        // get user from db
        $user = $this->userService->checkUsernamePassword(
            $logindata->username, 
            $logindata->password);

        // if the method returned false, the username and/or password were incorrect
        if (!$user) {
            $this->respondWithError(401, "Invalid Username or password");
            return;
        }

        // generate jwt
        $key = 'SendMeShekels';
        $payload = [
        'iss' => 'http://api/inholland.nl',
        'aud' => 'http://www.inholland.nl',
        'sub' => $user->username,
        'iat' => time(),
        'nbf' => time(),
        'exp' => time() + 3600
                    ];
        $jwt = JWT::encode($payload, $key, 'HS256');

        // return jwt
        $this->respond($jwt);
    }
    public function registrate()
    {
        
    }
}
