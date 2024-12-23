<?php

namespace routes;

class Orders
{
  // соединение с БД и таблицей "orders"
  private $conn;
  private $table_name = "orders";

  // свойства объекта
  public $order_id;
  public $date;
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
                order_id, date, client_first, client_last, client_patronymic, product_id, waranty, phone, date_receipt
            FROM
                " . $this->table_name . "
            ORDER BY
                order_id";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }
}
