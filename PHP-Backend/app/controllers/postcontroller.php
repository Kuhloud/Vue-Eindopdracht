<?php
namespace Controllers;
use Services\PostService;


class PostController extends Controller {

    private $postService; 

    // initialize services
    function __construct() {
        $this->postService = new PostService();
    }

    public function getPostsByThreadId($threadId)
    {
        $posts = $this->postService->getPostsByThreadId($threadId);
        $this->respond($posts);
    }
}