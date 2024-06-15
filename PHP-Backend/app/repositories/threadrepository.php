<?php
namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class ThreadRepository extends Repository
{
        function getAllThreads()
        {

                $stmt = $this->connection->prepare("SELECT * FROM threads");
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Thread');
                $threads = $stmt->fetchAll();

                return $threads;

        }
        function getThreadsByBoardName($board_name)
        {

                $stmt = $this->connection->prepare("SELECT * FROM threads WHERE board_id IN (SELECT board_id FROM boards WHERE board_name = :board_name)");
                $stmt->bindParam(':board_name', $board_name);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Thread');
                $threads = $stmt->fetchAll();

                return $threads;

        }
        function getThreadByTitle($title)
        {

                $stmt = $this->connection->prepare("SELECT * FROM threads WHERE title = :title");
                $stmt->bindParam(':title', $title);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Thread');
                $threads = $stmt->fetch();

                return $threads;
        }
        function getThreadById($threadId)
        {

                $stmt = $this->connection->prepare("SELECT * FROM threads WHERE thread_id = :thread_id");
                $stmt->bindParam(':thread_id', $threadId);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Thread');
                $threads = $stmt->fetch();

                return $threads;
        }

        function insert($board_id, $title, $first_post, $user_id)
        {
                $stmt = $this->connection->prepare("INSERT into threads (board_id, title, first_post, user_id, created_at) VALUES (:board_id, :title, :first_post, :user_id, NOW())");
                $stmt->bindParam(':board_id', $board_id);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':first_post', $first_post);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();

                $lastInsertId = $this->connection->lastInsertId();

                $stmt = $this->connection->prepare("SELECT * FROM threads WHERE thread_id = :thread_id");
                $stmt->bindParam(':thread_id', $lastInsertId);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Thread');
                $thread = $stmt->fetch();

                return $thread;
        }
        function updateReplies($threadId)
        {
                $stmt = $this->connection->prepare("SELECT COUNT(*) FROM posts p JOIN threads t ON p.thread_id = t.thread_id WHERE t.thread_id = :thread_id");
                $stmt->bindParam(':thread_id', $threadId);
                $stmt->execute();

                $totalReplies = $stmt->fetchColumn();

                $stmt = $this->connection->prepare("UPDATE threads SET replies = :replies WHERE thread_id = :thread_id");
                $stmt->bindParam(':thread_id', $threadId);
                $stmt->bindParam(':replies', $totalReplies);
                $stmt->execute();
                return $totalReplies;
        }
    }