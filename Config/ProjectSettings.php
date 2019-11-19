<?php


namespace Config;


use Libs\Controllers\NotFoundController;
use TaskApp\TaskApplication;

class ProjectSettings
{
    public const IS_DEBUG = true;
    public const APPLICATIONS = [
        ConfigApplication::class,
        TaskApplication::class
    ];

    public const MIDDLEWARE = [
        \Libs\Apps\Auth\Middleware\AuthMiddleware::class,
        \Libs\Apps\Auth\Middleware\RequiredAuthenticationMiddleware::class,
    ];

    public const ROUTING_TABLE_CLASSES = [
        ['/^auth(\/|)/', \Libs\Apps\Auth\RoutingTable::class],
        ['/^tasks(\/|)/', \TaskApp\RoutingTable::class],
    ];

    public const NOT_FOUND_CONTROLLER = NotFoundController::class;
}