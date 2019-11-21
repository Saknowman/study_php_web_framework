<?php


namespace TaskApp\Repositories;


use Libs\DB\Repository;
use TaskApp\Entities\Task;

class TasksRepository extends Repository
{
    protected function entityClass()
    {
        return Task::class;
    }

}