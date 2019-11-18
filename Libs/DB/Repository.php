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

    public function insert(Entity $entity)
    {
        $columns = implode(', ', $this->_columns());
        $values_columns = implode(', ', $this->_to_params($this->_columns()));
        $sql = "insert into {$this->_table_name} ({$columns}) values ({$values_columns})";
        $params = [];
        foreach ($this->_columns() as $key) {
            $params[$this->_to_param($key)] = $entity->$key;
        }
        $this->execute($sql, $params);
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

    private function _columns(): array
    {
        return $this->_entity_class::columns();
    }

    private function _to_param(string $key): string
    {
        return ':' . $key;
    }

    private function _to_params(array $keys): array
    {
        $result = [];
        foreach ($keys as $key) {
            $result[] = $this->_to_param($key);
        }

        return $result;
    }


}