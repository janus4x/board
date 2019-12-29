<?php

class Controller_Board extends Controller
{

    function __construct()
    {
        $this->model = new Model_Board();
        $this->view = new View();
    }
    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate('board_view.php', 'tpl_board.html',  $data);
    }
    function action_add()
    {
        $data = $this->model->add_data();
    }
}
