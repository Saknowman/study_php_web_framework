<?php


namespace Libs\Controllers;


use Config\ProjectSettings;
use Libs\Https\Request;
use Libs\Https\Response;
use Libs\Https\Status;

class Controller
{
    /**
     * @var Request
     */
    protected Request $_request;

    public function __construct()
    {
        $this->_request = Request::instance();
    }

    public function run($action, $params = [])
    {
        if (!method_exists($this, $action)) {
            return $this->render404("Page not found.");
        }

        return $this->$action($params);
    }

    protected function redirect($uri)
    {
        return Response::redirect($uri);
    }

    protected function render404($message='Page not found.')
    {
        $controller = ProjectSettings::NOT_FOUND_CONTROLLER;
        $controller = new $controller($message);
        return $controller->index([]);
    }
}