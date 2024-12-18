<?php

namespace objects;

class Orders
{
    // соединение с БД и таблицей "orders"
    private $conn;
    private $table_name = "orders";

    // свойства объекта
    public $order_id;
    public $client_first;
    public $client_last;
    public $client_patronymic;
    public $product_id;
    public $waranty;
    public $date_receipt;
    public $phone;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function readAll()
    {
        $query = "SELECT
                order_id, client_first, client_last, client_patronymic, product_id, waranty, date_receipt, post
            FROM
                " . $this->table_name . "
            ORDER BY
                order_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
