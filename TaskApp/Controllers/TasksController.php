<?php


namespace TaskApp\Controllers;


use Libs\Controllers\Controller;
use Libs\Https\Response;

class TasksController extends Controller
{
    public function index($params)
    {
        return $this->render('tasks/index');
    }

    public function detail($params)
    {
        $data = ['title' => 'Create web framework.', 'status' => 'DOING'];
        return $this->render('tasks/detail', $data);
    }

}