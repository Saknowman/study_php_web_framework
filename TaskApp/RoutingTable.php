<?php


namespace TaskApp;


use TaskApp\Controllers\TasksController;

class RoutingTable extends \Libs\Routing\RoutingTable
{
    protected array $urlPatterns = [
        ['', 'GET', TasksController::class, 'index'],
        ['detail', 'GET', TasksController::class, 'detail'],
    ];
}