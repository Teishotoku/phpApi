<?php

namespace objects;

class Employee
{
    // соединение с БД и таблицей "employee"
    private $conn;
    private $table_name = "employee";

    // свойства объекта
    public $employee_id;
    public $first_name;
    public $last_name;
    public $patronymic;
    public $post;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function readAll()
    {
        $query = "SELECT
                employee_id, first_name, last_name, patronymic, post
            FROM
                " . $this->table_name . "
            ORDER BY
                employee_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

