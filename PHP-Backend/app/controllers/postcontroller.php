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
    public function deletePost($postId)
    {
        $this->postService->deletePost($postId);
        $this->respond([
            "status" => "success",
            "message" => "Post deleted"
        ]);
    }
    public function editPost($postId)
    {
        $editedPost = $this->createObjectFromPostedJson("Models\\Post");

        $this->postService->editPost($postId, $editedPost->getMessage());
        $this->respond([
            "status" => "success",
            "message" => $editedPost->getMessage()
        ]);
    }
}