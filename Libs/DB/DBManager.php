<?php


namespace Libs\DB;


use Config\DBSettings;

class DBManager
{
    private static DBManager $instance;
    private \PDO $connection;
    private array $repository_table = array();

    private function __construct()
    {
        $this->initialize();
    }

    public function __destruct()
    {
        foreach ($this->repository_table as $repository){
            unset($repository);
        }
        unset($this->connection);
    }

    public static function instance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $repository_key
     * @return Repository
     */
    public function repository($repository_key)
    {
        return $this->repository_table[$repository_key];
    }

    public function registerRepositories(array $repository_table)
    {
        $this->repository_table = array_merge($this->repository_table, $repository_table);
    }


    private function initialize()
    {
        $dsn = $this->createDsn();

        $this->connection = new \PDO(
            $dsn,
            DBSettings::USER,
            DBSettings::PASSWORD
        );

        foreach(DBSettings::OPTIONS as $option){
            $this->connection->setAttribute($option[0], $option[1]);
        }

        $repositories = array();
        foreach(DBSettings::REPOSITORIES_TABLE as $repo_table){
            $repo = new $repo_table['repository'](
                $repo_table['table_name'],
                $this->connection);
            $repositories[$repo_table['key']] = $repo;
        }

        $this->registerRepositories($repositories);
    }

    private function createDsn(): string
    {
        $dsn = DBSettings::DRIVER . ":" .
            "dbname=" . DBSettings::DB_NAME . ";" .
            "host=" . DBSettings::HOST . ";";
        return $dsn;
    }
}