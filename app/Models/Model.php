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
    protected $sql, $data = [], $params = null;
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

    public function query($sql, $data = [], $params = null)
    {

        if ($data) {

            if ($params == null) {
                $params = str_repeat('s', count($data));
            }

            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param($params, ...$data);
            $stmt->execute();

            $this->query = $stmt->get_result();
        } else {

            $this->query = $this->connection->query($sql);
        }

        return $this;
    }

    public function first()
    {
        if (empty($this->query)) {
            $this->query($this->sql, $this->data, $this->params);
        }
        return $this->query->fetch_assoc();
    }

    public function get()
    {

        if (empty($this->query)) {
            $this->query($this->sql, $this->data, $this->params);
        }
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    public function paginate($cant)
    {

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        if ($this->sql) {

            $sql = $this->sql . " LIMIT " . ($page - 1) * $cant . ",{$cant}";
            $data = $this->query($sql, $this->data, $this->params)->get();
        } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} LIMIT " . ($page - 1) * $cant . ",{$cant}";
            $data = $this->query($sql)->get();
        }

        $total = $this->query('SELECT FOUND_ROWS() as total')->first()['total'];

        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');

        if (strpos($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        $last_page = ceil($total / $cant);

        return [
            'total' => $total,
            'from' => ($page - 1) * $cant + 1,
            'to' => ($page - 1) * $cant + count($data),
            'current_page' => $page,
            'last_page' => $last_page,
            'next_page_url' => $page < $last_page ? '/' . $uri . '?page=' . $page + 1 : null,
            'prev_page_url' => $page > 1 ? '/' . $uri . '?page=' . $page - 1 : null,
            'data' => $data
        ];
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
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id], 'i')->first();
    }

    public function where($column, $operator, $value = null)
    {
        if ($value == null) {
            $value = $operator;
            $operator = '=';
        }

        // SELECT * FROM {tabla solicitada} WHERE {column} {operator} {value}
        $this->sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} WHERE {$column} {$operator} ?";
        $this->data[] = $value;

        //$this->query($sql, [$value]);

        return $this;
    }

    public function create($data)
    {
        // INSERT INTO `contacts`(`id`, `name`, `email`, `phone`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')
        $columns = array_keys($data);
        $columns = implode(', ', $columns);

        $values = array_values($data);

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES (" . str_repeat('?, ', count($values) - 1) . "?)";

        $this->query($sql, $values);

        $insert_id = $this->connection->insert_id;

        return $this->find($insert_id);
    }

    public function update($id, $data)
    {
        // UPDATE `contacts` SET `id`='[value-1]',`name`='[value-2]',`email`='[value-3]',`phone`='[value-4]' WHERE 1
        $fields = [];

        foreach ($data as $key => $value) {
            $fields[] = "{$key} = ?";
        }

        $fields = implode(', ', $fields);

        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = ?";

        $values = array_values($data);
        $values[] = $id;

        $this->query($sql, $values);

        return $this->find($id);
    }

    public function delete($id)
    {
        // DELETE FROM `contacts` WHERE id = 0
        $sql = "DELETE FROM {$this->table} WHERE id = ?";

        $this->query($sql, [$id], 'i');
    }
}
