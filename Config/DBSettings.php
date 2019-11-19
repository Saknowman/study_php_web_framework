<?php


namespace Config;


use Libs\Apps\Auth\Entities\User;
use Libs\Apps\Auth\Repositories\UsersRepository;
use TaskApp\Entities\Task;
use TaskApp\Repositories\TasksRepository;

class DBSettings
{
    public const USE_DB = true;
    public const USER = 'sample_app_user';
    public const PASSWORD = 'Pasuwa-do123';
    public const DRIVER = 'mysql';
    public const DB_NAME = "sample_app_db";
    public const HOST = "localhost";
    public const OPTIONS =
        [
            [\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION]
        ];

    public const REPOSITORIES_TABLE =
        [
            [
                'key' => "users",
                'table_name' => 'users',
                'entity' => User::class,
                "repository" => UsersRepository::class
            ],
            [
                'key' => "tasks",
                'table_name' => 'tasks',
                'entity' => Task::class,
                "repository" => TasksRepository::class
            ],
        ];
}