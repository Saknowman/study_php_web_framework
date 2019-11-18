<?php


namespace Config;


use Libs\Application;

class ConfigApplication extends Application
{
    public function ready()
    {
        echo "Config application is ready <br>";
    }
}