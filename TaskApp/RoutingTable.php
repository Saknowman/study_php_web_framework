<?php


namespace TaskApp;


use TaskApp\Controllers\TasksController;

class RoutingTable extends \Libs\Routing\RoutingTable
{
    protected array $urlPatterns = [
        ['', 'GET', TasksController::class, 'index'],
        ['', 'POST', TasksController::class, 'store'],
        ['create', 'GET', TasksController::class, 'create'],
        ['int:id', 'GET', TasksController::class, 'detail'],
        ['int:id', 'PUT', TasksController::class, 'update'],
        ['int:id', 'DELETE', TasksController::class, 'delete'],
        ['int:id/edit', 'GET', TasksController::class, 'edit'],
    ];
}