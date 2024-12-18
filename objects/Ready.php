<?php

namespace objects;

class Ready 
{
    // соединение с БД и таблицей "ready"
    private $conn;
    private $table_name = "ready";

    // свойства объекта
    public $order_id;
    public $type_repair;
    public $cost_repair;
    public $date_execution;
    public $sms_client;
    public $date_receipt;
    public $payment;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function readAll()
    {
        $query = "SELECT
                order_id, type_repair, cost_repair, date_execution,sms_client, date_receipt, payment 
            FROM
                " . $this->table_name . "
            ORDER BY
                order_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
