<?php
namespace Controllers;

use Services\ThreadService;


class ThreadController extends Controller
{

    private $threadService;

    // initialize services
    function __construct()
    {
        $this->threadService = new ThreadService();
    }
    public function createthread()
    {

        try {
            $thread = $this->createObjectFromPostedJson("Models\\Thread");
            $newThread = $this->threadService->insert($thread);
            $this->respond([
                "thread_id" => $newThread->getThreadId(),
                "title" => $newThread->getTitle(),
                "user_id" => $newThread->getUserId()
            ]);
        } catch (\Exception $e) {
            $this->respondWithError(400, $e->getMessage());

        }
    }
    public function updatePostCount($thread_id)
    {
        $totalPosts = $this->threadService->updateReplies($thread_id);
        $this->respond($totalPosts);
    }
    public function getThreadsByBoardName($name)
    {
        $threads = $this->threadService->getThreadsByBoardName($name);
        $this->respond($threads);
    }
    public function getThreadById($threadId)
    {
        $threads = $this->threadService->getThreadById($threadId);
        $this->respond($threads);
    }
    public function deleteThread($threadId)
    {
        $this->threadService->deleteThread($threadId);
        $this->respond([
            "status" => "success",
            "message" => "Thread deleted"
        ]);
    }
}