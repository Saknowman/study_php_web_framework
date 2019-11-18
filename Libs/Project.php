<?php


namespace Libs;


use Libs\Https\Response;

/**
 * Class Project
 * @package Libs
 */
class Project
{
    private static Project $_instance;

    private function __construct()
    {
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
        $response = new Response('This is content of response.');
        $response->send();
    }
}