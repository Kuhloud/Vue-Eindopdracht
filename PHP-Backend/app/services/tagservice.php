<?php
namespace Services;
use Repositories\TagRepository;


class TagService {

    public function insert($tag) {
        // retrieve data
        $repository = new TagRepository();
        if (!$repository->existingTag($tag->getTagName())) {
            return $repository->insert($tag->getTagName()); 
        }
        return $repository->getTagByName($tag->getTagName());
    }
    public function getTagsByThreadId($thread_id) {
        // retrieve data
        $repository = new TagRepository();
        $threadTags = $repository->getTagsByThreadId($thread_id);
        return $threadTags;
    }
}