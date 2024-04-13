<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Create Router instance
$router = new \Bramus\Router\Router();

$router->setNamespace('Controllers');

// routes for the board endpoint
$router->get('/boards', 'BoardController@getBoards');
$router->get('/board/([^/]+)', 'BoardController@getBoardByName');

// routes for the thread endpoint
$router->get('/board/([^/]+)/threads', 'ThreadController@getThreadsByBoardName');
$router->get('/thread/([^/]+)', 'ThreadController@getThreadByTitle');

// routes for the post endpoint

// routes for the users endpoint
$router->post('/users/login', 'UserController@login');
$router->post('/users/signup', 'UserController@registrate');

// Run it!
$router->run();