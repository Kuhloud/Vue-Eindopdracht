<?php
namespace Controllers;
use Services\ThreadService;


class ThreadController extends Controller {

    private $threadService; 

    // initialize services
    function __construct() {
        $this->threadService = new ThreadService();
    }

    // router maps this to /article and /article/index automatically
    function currentThread($thread)
    {
        $_SESSION['currentthread'] = $thread;
    }
    public function createthread() {
        
        try
        {
            $thread = $this->createObjectFromPostedJson("Models\\Thread");
            $newThread = $this->threadService->insert($thread);
            $this->respond([
                "thread_id" => $newThread->getThreadId(),
                "title" => $newThread->getTitle(),
                "user_id" => $newThread->getUserId()
            ]);
        }
        catch (\Exception $e)
        {
            $this->respondWithError(400, $e->getMessage());
        
        }
    }
    public function getThreadsByBoardName($name) {
        $threads = $this->threadService->getThreadsByBoardName($name);
        $this->respond($threads);
    }
    public function getThreadByTitle($title) {
        $threads = $this->threadService->getThreadByTitle($title);
        $this->respond($threads);
    }
    public function getThreadById($threadId) {
        $threads = $this->threadService->getThreadById($threadId);
        $this->respond($threads);
    }
}