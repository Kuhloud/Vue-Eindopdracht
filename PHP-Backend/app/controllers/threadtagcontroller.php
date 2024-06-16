<?php
namespace Controllers;
use Services\ThreadTagService;

class ThreadTagController extends Controller
{
    private $threadTagService;

    // initialize services
    function __construct()
    {
        $this->threadTagService = new ThreadTagService();
    }


    public function addThreadTag($thread_id)
    {
        $threadTag = $this->createObjectFromPostedJson("Models\\ThreadTag");
        $threadTag->setThreadId($thread_id);
        $setThreadTag = $this->threadTagService->addTagToThread($threadTag);
        $this->respond([
            "thread_id" => $setThreadTag->getThreadId(),
            "tag_id" => $setThreadTag->getTagId()
        ]);
    }
    
    private function getTags(int $thread_id)
    {
        try 
        {
            $tags = $this->threadTagService->getTagsByThreadId($thread_id);
            if (empty($tags)) {
                echo json_encode([]);
                return;
            }
            header("Content-type: application/json");
            echo json_encode($tags);
        } 
        catch (\Exception $e) 
        {
            $this->respondWithError(400, $e->getMessage());
        }
    }
}