<?php
namespace Repositories;

use PDO;
use Repositories\Repository;

class PostRepository extends Repository
{
    function insert($thread_id, $user_id, $message)
    {
            $stmt = $this->connection->prepare("INSERT into posts (thread_id, user_id, message, posted_at) VALUES (:thread_id, :user_id, :message, NOW())");
            $stmt->bindParam(':thread_id', $thread_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':message', $message);
            $stmt->execute();

            $lastInsertId = $this->connection->lastInsertId();

            $stmt = $this->connection->prepare("SELECT * FROM posts WHERE post_id = :post_id");
            $stmt->bindParam(':post_id', $lastInsertId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Post');
            return $stmt->fetch();
    }
    function getPostsByThreadId($threadId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM posts WHERE thread_id IN (SELECT thread_id FROM threads WHERE thread_id = :thread_id)");
        $stmt->bindParam(':thread_id', $threadId);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Post');
        $posts = $stmt->fetchAll();

        return $posts;
    }
}
