<?php


namespace TaskApp\Controllers;


use Libs\Controllers\Controller;
use Libs\Https\Response;

class TasksController extends Controller
{
    public function index($params)
    {
        return new Response("This is index of task controller. <br> name: " . $params['name']);
    }

}