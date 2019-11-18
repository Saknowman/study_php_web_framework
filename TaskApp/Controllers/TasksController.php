<?php


namespace TaskApp\Controllers;


use Libs\Controllers\Controller;
use Libs\DB\DBManager;
use Libs\Https\Response;

class TasksController extends Controller
{
    /**
     * @var \Libs\DB\Repository
     */
    private $_repository;

    public function __construct()
    {
        parent::__construct();
        $this->_repository = DBManager::instance()->repository('tasks');
    }

    public function index($params)
    {
        $data = ['tasks' => $this->_repository->all()];
        return $this->render('tasks/index', $data);
    }

    public function detail($params)
    {
        $data = ['task' => $this->_repository->get($params['id'])];
        return $this->render('tasks/detail', $data);
    }

}