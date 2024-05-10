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
    public function index()
    {
        $threadId = $_SESSION['thread_id'];
        $thread = $this->threadService->getThreadById($threadId);
        $this->currentThread($thread);
    }
    function currentThread($thread)
    {
        $_SESSION['currentthread'] = $thread;
    }
    public function createthread() {
        
        try
        {
            $thread = $this->createObjectFromPostedJson("Models\\Thread");
            $thread = $this->threadService->insert($thread);
            $this->respond($thread);
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
}