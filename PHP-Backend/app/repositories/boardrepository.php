<?php
namespace Repositories;

use PDO;
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

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Board');
                $board = $stmt->fetch();

                return $board;

        }
        function getBoardByName(string $boardName)
        {

                $stmt = $this->connection->prepare("SELECT * FROM boards WHERE board_name = :boardName");
                $stmt->bindParam(':boardName', $boardName);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Board');
                $boardId = $stmt->fetch();

                return $boardId;

        }
        function insert($board)
        {
                $stmt = $this->connection->prepare("INSERT into boards (board_name, board_description) VALUES (:boardName, :boardDescription)");
                $stmt->bindParam(':boardName', $board->getBoardName());
                $stmt->bindParam(':boardDescription', $board->getBoardDescription());

                $stmt->execute([$board->getBoardName()]);

        }
        function updatePostCount($boardid)
        {
                $stmt = $this->connection->prepare("UPDATE boards SET total_messages = total_messages + 1 WHERE board_id = :board_id");
                $stmt->bindParam(':board_id', $boardid);
                $stmt->execute();
        }
        function updateThreadCount($boardId)
        {
                $stmt = $this->connection->prepare("UPDATE boards SET total_threads = total_threads + 1 WHERE board_id = :board_id");
                $stmt->bindParam(':board_id', $boardId);
                $stmt->execute();
        }
}