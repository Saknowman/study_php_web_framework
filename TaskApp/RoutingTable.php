<?php


namespace TaskApp;


use TaskApp\Controllers\TasksController;

class RoutingTable extends \Libs\Routing\RoutingTable
{
    protected array $urlPatterns = [
        ['str:name', 'GET', TasksController::class, 'index'],
        ['detail/int:id', 'GET', TasksController::class, 'detail'],
    ];
}