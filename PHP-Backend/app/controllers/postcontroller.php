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
    public function addPost()
    {
        try
        {
            $post = $this->createObjectFromPostedJson("Models\\Post");
            $newPost = $this->postService->insert($post);
            $this->respond($newPost);
        }
        catch (\Exception $e)
        {
            $this->respondWithError(400, $e->getMessage());
        
        }
    }
}