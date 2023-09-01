<?php

namespace App\Models;

use mysqli;

class Model
{
    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;

    protected $connection;
    protected $query;
    protected $table;

    public function __construct()
    {
        $this->connection();
    }

    public function connection()
    {
        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if ($this->connection->connect_error) {
            die('Error de conexión: ' . $this->connection->connect_error);
        }
    }

    public function query($sql)
    {
        $this->query = $this->connection->query($sql);

        return $this;
    }

    public function first()
    {
        return $this->query->fetch_assoc();
    }

    public function get()
    {
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    // Different type of queries

    public function all()
    {
        // SELECT * FROM {tabla solicitada}
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->get();
    }

    public function find($id)
    {
        // SELECT * FROM {tabla solicitada} WHERE id = {$id}
        $sql = "SELECT * FROM {$this->table} WHERE id = {$id}";
        return $this->query($sql)->first();
    }

    public function where($column, $operator, $value = null)
    {
        if ($value == null) {
            $value = $operator;
            $operator = '=';
        }

        // SELECT * FROM {tabla solicitada} WHERE {column} {operator} {value}
        $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} '{$value}'";
        $this->query($sql);

        return $this;
    }

    public function create($data)
    {
        // INSERT INTO `contacts`(`id`, `name`, `email`, `phone`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')
        $columns = array_keys($data);
        $columns = implode(', ', $columns);

        $values = array_values($data);
        $values = "'" . implode("', '", $values) . "'";

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";

        $this->query($sql);

        $insert_id = $this->connection->insert_id;

        return $this->find($insert_id);
    }

    public function update($id, $data)
    {
        // UPDATE `contacts` SET `id`='[value-1]',`name`='[value-2]',`email`='[value-3]',`phone`='[value-4]' WHERE 1
        $fields = [];

        foreach ($data as $key => $value) {
            $fields[] = "{$key} = '{$value}'";
        }

        $fields = implode(', ', $fields);

        //return $fields;

        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = {$id}";

        $this->query($sql);
        return $this->find($id);
    }

    public function delete($id)
    {
        // DELETE FROM `contacts` WHERE id = 0
        $sql = "DELETE FROM {$this->table} WHERE id = {$id}";

        $this->query($sql);
    }
}