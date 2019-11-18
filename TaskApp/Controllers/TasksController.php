<?php


namespace TaskApp\Controllers;


use Libs\Controllers\Controller;
use Libs\Https\Response;

class TasksController extends Controller
{
    public function index($params)
    {
        $data = ['name' => $params['name']];
        return $this->render('tasks/index', $data);
    }

    public function detail($params)
    {
        $data = ['id' => $params['id'], 'title' => 'Create web framework.', 'status' => 'DOING'];
        return $this->render('tasks/detail', $data);
    }

}