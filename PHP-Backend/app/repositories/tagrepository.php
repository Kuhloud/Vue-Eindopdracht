<?php
namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class TagRepository extends Repository
{
function existingTag($tag_name) {
        $stmt = $this->connection->prepare("SELECT * FROM tags WHERE tag_name = :tag_name");
        $stmt->bindParam(':tag_name', $tag_name);
        $stmt->execute();
        if ($stmt->fetch()) 
        {
                return true;
        } 
        else 
        {
                return false;
        }
}

function insert($tag)
{
        try
        {
                $stmt = $this->connection->prepare("INSERT into tags (tag_name) VALUES (:tag_name)");
                $stmt->bindParam(':tag_name', $tag->tag_name);
                //return $stmt->execute(); 
                return $this->connection->lastInsertId();
                
        }
        catch (PDOException $e) 
        {
                echo "Error: " . $e->getMessage();
        }
}
function getTagIdByName($tag)
{
        $stmt = $this->connection->prepare("SELECT tag_id FROM tags WHERE tag_name = :tag_name");
        $stmt->bindParam(':tag_name', $tag->tag_name);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
        $tagId = $stmt->fetch();
        return $tagId;
}
}