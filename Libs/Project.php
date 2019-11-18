<?php


namespace Libs;


use Libs\Https\Request;
use Libs\Https\Response;
use Libs\Https\Status;

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
        $response = new Response($this->_request->pathInfo());
        $response->send();
    }
}