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
    public function addTag()
    {
        try
        {
            $tag = $this->createObjectFromPostedJson("Models\\Tag");
            $threadTag = $this->tagService->insert($tag);
            //$this->respond($threadTag);
            $this->respond([
                "tag_id" => $threadTag->getTagId(),
            ]);
        }
        catch (\Exception $e)
        {
            $this->respondWithError(400, $e->getMessage());
        
        }
    }
    public function getTagsByThreadId($threadId)
    {
        $tags = $this->tagService->getTagsByThreadId($threadId);
        $this->respond($tags);
    }
}