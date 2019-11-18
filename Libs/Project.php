<?php


namespace Libs;


/**
 * Class Project
 * @package Libs
 */
class Project
{
    private static Project $_instance;

    public static function instance()
    {
        if (empty(self::$_instance)) {
            self::$_instance = new Project();
        }

        return self::$_instance;
    }

    public function run()
    {
        echo "Project running.";
    }
}