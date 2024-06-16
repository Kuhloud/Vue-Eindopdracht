<?php
namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;



class BoardRepository extends Repository
{
        function getBoards($offset = NULL, $limit = NULL)
        {
                try {
                        $query = "SELECT * FROM boards";
                        if (isset($limit) && isset($offset)) {
                            $query .= " LIMIT :limit OFFSET :offset ";
                        }
                        $stmt = $this->connection->prepare($query);
                        if (isset($limit) && isset($offset)) {
                            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                        }
                        $stmt->execute();
            
                        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Board');
                        $boards = $stmt->fetchAll();
            
                        return $boards;
                    } catch (PDOException $e) {
                        echo $e;
                    }
        }
        function getBoardById(int $boardId)
        {

                $stmt = $this->connection->prepare("SELECT * FROM boards WHERE board_id = :boardId");
                $stmt->bindParam(':boardId', $boardId);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Board');
                $board = $stmt->fetch();

                return $board;

        }
        function insert($board_name, $board_description)
        {
                $stmt = $this->connection->prepare("INSERT into boards (board_name, board_description) VALUES (:boardName, :boardDescription)");
                $stmt->bindParam(':boardName', $board_name);
                $stmt->bindParam(':boardDescription', $board_description);

                $stmt->execute();
        }
        function updatePostCount($boardId)
        {
                $stmt = $this->connection->prepare("
                    SELECT COUNT(*) 
                    FROM posts p 
                    JOIN threads t ON p.thread_id = t.thread_id 
                    JOIN boards b ON t.board_id = b.board_id 
                    WHERE b.board_id = :board_id");
                $stmt->bindParam(':board_id', $boardId);
                $stmt->execute();

                $totalPosts = $stmt->fetchColumn();

                $stmt = $this->connection->prepare("UPDATE boards SET total_messages = :total_messages WHERE board_id = :board_id");
                $stmt->bindParam(':board_id', $boardId);
                $stmt->bindParam(':total_messages', $totalPosts);
                $stmt->execute();
                return $totalPosts;
        }
        function updateThreadCount($boardId)
        {
                $stmt = $this->connection->prepare("SELECT COUNT(*) FROM threads t JOIN boards b ON t.board_id = b.board_id WHERE b.board_id = :board_id");
                $stmt->bindParam(':board_id', $boardId);
                $stmt->execute();

                $totalThreads = $stmt->fetchColumn();

                $stmt = $this->connection->prepare("UPDATE boards SET total_threads = :total_threads WHERE board_id = :board_id");
                $stmt->bindParam(':board_id', $boardId);
                $stmt->bindParam(':total_threads', $totalThreads);
                $stmt->execute();
                return $totalThreads;
        }
}