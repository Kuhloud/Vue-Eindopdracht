<?php
namespace Services;
use Repositories\ThreadRepository;


class ThreadService {
    public function getAllThreads() {
        // retrieve data
        $repository = new ThreadRepository();
        return $repository->getAllThreads();
    }
    public function getThreadsByBoardName($board_name) {
        // retrieve data
        $repository = new ThreadRepository();
        $threads = $repository->getThreadsByBoardName($board_name);
        return $threads;
    }
    public function getThreadById($threadId) {
        // retrieve data
        $repository = new ThreadRepository();
        $thread = $repository->getThreadById($threadId);
        return $thread;
    }

    public function insert($thread) {
        // retrieve data
        $repository = new ThreadRepository();
        $thread = $repository->insert($thread->getBoardId(), $thread->getTitle(), $thread->getFirstPost(), $thread->getUserId());    
        return $thread;   
    }
    public function updateReplies($threadId) {
        // retrieve data
        $repository = new ThreadRepository();
        return $repository->updateReplies($threadId);
    }
    public function deleteThread($threadId) {
        // retrieve data
        $repository = new ThreadRepository();
        return $repository->deleteThread($threadId);
    }
}
