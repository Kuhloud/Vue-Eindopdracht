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
    public function updateThreadCount($boardId) {
        // retrieve data
        $repository = new BoardRepository();
        return $repository->updateThreadCount($boardId);
    }
    public function updatePostCount($boardId) {
        // retrieve data
        $repository = new BoardRepository();
        return $repository->updatePostCount($boardId);
    }
    public function insert($board) {
        // retrieve data
        $repository = new BoardRepository();
        $repository->insert($board->getBoardName(), $board->getBoardDescription());        
    }
}