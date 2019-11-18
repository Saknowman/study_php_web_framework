<?php


namespace Libs\DB;


class Repository
{
    protected string $_table_name;
    protected \PDO $_connection;
    private string $_entity_class;

    public function __construct($table_name, $entity_class, \PDO $connection)
    {
        $this->_table_name = $table_name;
        $this->_connection = $connection;
        $this->_entity_class = $entity_class;
    }

    public function all()
    {
        $sql = "select * from {$this->_table_name}";
        return $this->fetchAll($sql);
    }

    public function get($id)
    {
        $result = $this->where('id', '=', $id);
        return empty($result[0]) ? null : $result[0];
    }

    public function where($column, $operator, $value){
        $sql = "select * from {$this->_table_name} where {$column} {$operator} :value";
        return $this->fetchAll($sql, [':value' => $value]);
    }

    public function execute($sql, $params = [])
    {
        $query = $this->_connection->prepare($sql);
        $query->execute($params);
        return $query;
    }

    public function fetchAll($sql, $params = [])
    {
        $query = $this->execute($sql, $params);
        return $query->fetchAll(\PDO::FETCH_CLASS, $this->_entity_class);
    }
}