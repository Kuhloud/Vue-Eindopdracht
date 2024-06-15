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
    private function checkRequiredFields(string $threadTags)
    {
        $requiredFields = ['thread_id', 'tags'];
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (!isset($threadTags->$field)) 
            {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            echo json_encode([
            "status" => "error", 
            "message" => "Missing required fields", 
            "missing_fields" => $missingFields
            ], JSON_THROW_ON_ERROR);
        return;
        }
    }
}