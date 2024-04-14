<?php
namespace Services;

use Repositories\BoardRepository;


class BoardService {
    public function getBoards($offset = NULL, $limit = NULL) {
        // retrieve data
        $repository = new BoardRepository();
        $boards = $repository->getBoards($offset = NULL, $limit = NULL);
        return $boards;
    }
    public function getBoardById($boardId) {
        // retrieve data
        $repository = new BoardRepository();
        $board = $repository->getBoardById($boardId);
        return $board;
    }
    public function getBoardIdByName($boardName) {
        // retrieve data
        $repository = new BoardRepository();
        $boardId = $repository->getBoardIdByName($boardName);
        return $boardId;
    }
    public function getBoardByName($boardName) {
        // retrieve data
        $repository = new BoardRepository();
        $boardId = $repository->getBoardByName($boardName);
        return $boardId;
    }
    public function updateThreadCount($boardId) {
        // retrieve data
        $repository = new BoardRepository();
        $repository->updateThreadCount($boardId);
    }
    public function insert($board) {
        // retrieve data
        $repository = new BoardRepository();
        $repository->insert($board);        
    }
}