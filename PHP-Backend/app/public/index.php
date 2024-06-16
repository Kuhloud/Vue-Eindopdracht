<?php
$allowed_origins = array("http://localhost:5173", "http://localhost", "http://localhost:8080");
if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed_origins)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

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
$router->get('/board/(\d+)', 'BoardController@getBoardById');
$router->put('/board/(\d+)/totalthreads', 'BoardController@updateThreadCount');
$router->put('/board/(\d+)/totalmessages', 'BoardController@updatePostCount');

// routes for the thread endpoint
$router->get('/board/(\d+)/threads', 'ThreadController@getThreadsByBoardId');
$router->post('/thread', 'ThreadController@createThread');
$router->get('/thread/(\d+)', 'ThreadController@getThreadById');
$router->put('/thread/(\d+)/totalreplies', 'ThreadController@updatePostCount');
$router->delete('/thread/(\d+)/delete', 'ThreadController@deleteThread');

// routes for the tag endpoint
$router->post('/tag', 'TagController@addTag');
$router->get('/tags/(\d+)', 'TagController@getTagsByThreadId');

// routes for the thread_tag endpoint
$router->post('/threadtag/(\d+)', 'ThreadTagController@addThreadTag');

// routes for the post endpoint
$router->get('/thread/(\d+)/posts', 'PostController@getPostsByThreadId');
$router->post('/post', 'PostController@addPost');
$router->delete('/post/(\d+)/delete', 'PostController@deletePost');
$router->put('/post/(\d+)/edit', 'PostController@editPost');

// routes for the user endpoint
$router->post('/users/login', 'UserController@login');
$router->post('/users/signup', 'UserController@signup');
$router->get('/user/(\d+)', 'UserController@getUserById');

// routes for the user_role endpoint
$router->get('/userrole/(\d+)', 'UserRoleController@getRoleById');

// Run it!
$router->run();