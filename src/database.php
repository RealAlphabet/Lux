<?php

class DB
{
    private static $connection;

    public static function connection() {
        return static::$connection
            ?? static::$connection = new PDO(sprintf('mysql:host=%s;dbname=%s', DB_HOST, DB_NAME), DB_USER, DB_PASS);
    }

    public static function table($table) {
        return new QueryBuilder(self::connection(), $table);
    }
}

class QueryBuilder
{
    private $connection;
    private $table;
    private $where;

    function __construct($connection, $table) {
        $this->connection = $connection;
        $this->table = $table;
    }

    function where($property, $operator, $value) {
        if (is_string($value)) $value = "\"$value\"";
        $this->where = "$property $operator $value";
        return $this;
    }

    function get() {
        $table = $this->table;
        $where = $this->where;

        if ($where) {
            return $this->connection->query("SELECT * FROM $table WHERE $where")->fetchAll(PDO::FETCH_ASSOC);

        } else {
            return $this->connection->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    function first() {
        return $this->get()[0];
    }

    function delete() {
        $table = $this->table;
        $where = $this->where;

        if ($where) {
            return $this->connecton->exec("DELETE FROM $table WHERE $where");
        }
    }
}
