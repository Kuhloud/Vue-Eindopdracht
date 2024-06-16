<?php
namespace Services;
use Repositories\PostRepository;


class PostService {
    public function insert($post) {
        // retrieve data
        $repository = new PostRepository();
        return $repository->insert($post->getThreadId(), $post->getUserId(), $post->getMessage());        
    }
    public function getPostsByThreadId($threadId) {
        // retrieve data
        $repository = new PostRepository();
        $posts = $repository->getPostsByThreadId($threadId);
        return $posts;
    }
    public function deletePost($postId) {
        // retrieve data
        $repository = new PostRepository();
        return $repository->deletePost($postId);
    }
    public function editPost($postId, $message) {
        // retrieve data
        $repository = new PostRepository();
        return $repository->updatePost($postId, $message);
    }
}