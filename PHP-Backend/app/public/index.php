<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: 'Origin, X-Requested-With, Content-Type, Accept, Authorization");
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
$router->put('/board/(\d+)/totalthreads', 'BoardController@updateThreadCount');
$router->put('/board/(\d+)/totalmessages', 'BoardController@updatePostCount');

// routes for the thread endpoint
$router->get('/board/([^/]+)/threads', 'ThreadController@getThreadsByBoardName');
$router->post('/thread', 'ThreadController@createThread');
$router->get('/thread/([^/]+)', 'ThreadController@getThreadByTitle');
$router->put('/thread/(\d+)/totalreplies', 'ThreadController@updatePostCount');

// routes for the tag endpoint
$router->post('/tag', 'TagController@addTag');
$router->post('/threadtag/(\d+)', 'ThreadTagController@addThreadTag');

// routes for the post endpoint
$router->get('/thread/(\d+)/posts', 'PostController@getPostsByThreadId');
$router->post('/post', 'PostController@addPost');

// routes for the user endpoint
$router->post('/users/login', 'UserController@login');
$router->post('/users/signup', 'UserController@signup');
$router->get('/user/(\d+)', 'UserController@getUserById');

// Run it!
$router->run();