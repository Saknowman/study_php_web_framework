<?php


namespace Libs;


use Config\ProjectSettings;
use Libs\Controllers\Controller;
use Libs\DB\DBManager;
use Libs\Https\Request;
use Libs\Https\Response;
use Libs\Https\Status;
use Libs\Middleware\MiddlewareManager;
use Libs\Routing\Router;
use TaskApp\Controllers\TasksController;

/**
 * Class Project
 * @package Libs
 */
class Project
{
    private static Project $_instance;
    private Request $_request;
    private Router $_router;
    private MiddlewareManager $middleware_manager;

    private function __construct()
    {
        DBManager::instance();
        $this->_request = Request::instance();
        $this->_router = new Router(ProjectSettings::ROUTING_TABLE_CLASSES);
        $this->middleware_manager = new MiddlewareManager(ProjectSettings::MIDDLEWARE);

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
        $result = $this->middleware_manager->processRequest($this->_request);
        if ($result instanceof Response) {
            $result->send();
            return;
        }
        list($controller, $action, $params) = $this->_selectController();
        $response = $this->_actionController($controller, $action, $params);
        $response = $this->middleware_manager->processResponse($response);
        $response->send();
    }

    private function _selectController()
    {
        $result = $this->_router->resolve($this->_request);
        if (is_null($result)) {
            $controller = ProjectSettings::NOT_FOUND_CONTROLLER;
            return [new $controller(), 'index', []];
        }
        return [new $result['class'], $result['action'], $result['params']];
    }

    private function _actionController(Controller $controller, string $action, array $params)
    {
        return $controller->run($action, $params);
    }
}