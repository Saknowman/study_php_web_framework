<?php


namespace Libs;


use Libs\Controllers\Controller;
use Libs\Https\Request;
use Libs\Https\Response;
use Libs\Https\Status;
use TaskApp\Controllers\TasksController;

/**
 * Class Project
 * @package Libs
 */
class Project
{
    private static Project $_instance;
    private Request $_request;

    private function __construct()
    {
        $this->_request = Request::instance();
    }

    public static function instance()
    {
        if (empty(self::$_instance)) {
            self::$_instance = new Project();
        }

        return self::$_instance;
    }

    public function run()
    {
        list($controller, $action, $params) = $this->_selectController();
        $response = $this->_actionController($controller, $action, $params);
        $response->send();
    }

    private function _selectController()
    {
        $controller = new TasksController();
        $action = 'index';
        $params = ['name' => 'John'];
        return [$controller, $action, $params];
    }

    private function _actionController(Controller $controller, string $action, array $params)
    {
        return $controller->run($action, $params);
    }
}