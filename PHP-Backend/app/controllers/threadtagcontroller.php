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


    private function addThreadTags(int $thread_id, array $tags)
    {
        $threadTags = [];
        foreach ($tags as $tag) 
        {
            $tag = $this->createObjectFromPostedJson("Models\\ThreadTag");
            $this->threadTagService->addTagToThread($threadTag);
            $threadTags[] = $threadTag;
        }
        if (empty($threadTags)) {
            return;
        }
        return $threadTags;
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
        catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
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