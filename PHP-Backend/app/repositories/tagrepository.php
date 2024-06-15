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

function insert($tag_name)
{
    try
    {
        $stmt = $this->connection->prepare("INSERT into tags (tag_name) VALUES (:tag_name)");
        $stmt->bindParam(':tag_name', $tag_name);
        $stmt->execute(); 
        $lastInsertId = $this->connection->lastInsertId();

        $stmt = $this->connection->prepare("SELECT * FROM tags WHERE tag_id = :tag_id ");
        $stmt->bindParam(':tag_id', $lastInsertId);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Tag');
        $tag = $stmt->fetch();

        return $tag;
    }
    catch (PDOException $e) 
    {
        error_log("Error: " . $e->getMessage()); // Log the error message
        return false; // Return false or some other value indicating failure
    }
}
function getTagByName($tag_name)
{
        $stmt = $this->connection->prepare("SELECT * FROM tags WHERE tag_name = :tag_name");
        $stmt->bindParam(':tag_name', $tag_name);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Tag');
        $tag = $stmt->fetch();
        return $tag;
}
}