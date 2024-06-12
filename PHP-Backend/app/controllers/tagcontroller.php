<?php
namespace Controllers;
use Services\TagService;

class TagController extends Controller
{
    private $tagService;

    // initialize services
    function __construct()
    {
        $this->tagService = new TagService();
    }
    private function addTags(array $tags)
    {
        try
        {
            foreach ($tags as $tag) 
            {
                $tag = $this->createObjectFromPostedJson("Models\\Tag");
                $tagId = $this->tagService->insert($tag);
                $this->respond($tagId);
            }
        }
        catch (\Exception $e)
        {
            $this->respondWithError(400, $e->getMessage());
        
        }
    }
    
    private function checkRequiredFields(string $newThread)
    {
        $requiredFields = ['thread_id, tags'];
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (!isset($newThread->$field)) 
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