<?php

namespace Controllers;
use Services\BoardService;



class BoardController extends Controller {

    private $boardService;

    // initialize services
    function __construct() {
        $this->boardService = new BoardService();
    }
    public function getBoards() {

        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }
      
        // retrieve data 
        $boards = $this->boardService->getBoards($offset, $limit);
        $this->respond($boards);
    

    }
    public function getBoardById($id) {  

        $board = $this->boardService->getBoardById($id);
        $this->respond($board);


    }
    public function updateThreadCount($board_id) {
        $totalThreads = $this->boardService->updateThreadCount($board_id);
        $this->respond($totalThreads);
    }
    
    public function updatePostCount($board_id) {
        $totalPosts = $this->boardService->updatePostCount($board_id);
        $this->respond($totalPosts);
    }
}