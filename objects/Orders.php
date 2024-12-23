<?php

namespace objects;

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
  public $client_patronomyc;
  public $product_id;
  public $waranty;
  public $phone;
  public $date_receipt;

  public function __construct($db)
  {
    $this->conn = $db;
  }
  public function readAll()
  {
    $query = "SELECT
                order_id, date, client_first, client_last, client_patronomyc, product_id, waranty, phone, date_receipt
            FROM
                " . $this->table_name . "
            ORDER BY
                order_id";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }
  public function create()
  {
    $query = "insert into " . $this->table_name . " (category_id,product_name,description,price,created) 
        values (:category_id,:product_name,:description,:price,:created)";
    $stmt = $this->conn->prepare($query);
    $this->order_id = htmlspecialchars(strip_tags($this->order_id));
    $this->date = htmlspecialchars(strip_tags($this->date));
    $this->client_first = htmlspecialchars(strip_tags($this->client_first));
    $this->client_last = htmlspecialchars(strip_tags($this->client_last));
    $this->client_patronomyc = htmlspecialchars(strip_tags($this->client_patronomyc));
    $this->product_id = htmlspecialchars(strip_tags($this->product_id));
    $this->waranty = htmlspecialchars(strip_tags($this->waranty));
    $this->phone = htmlspecialchars(strip_tags($this->phone));
    $this->date_receipt = htmlspecialchars(strip_tags($this->date_receipt));
    $stmt->bindParam(':order_id', $this->order_id);
    $stmt->bindParam(':date', $this->date);
    $stmt->bindParam(':client_first', $this->client_first);
    $stmt->bindParam(':client_last', $this->client_last);
    $stmt->bindParam(':client_patronomyc', $this->client_patronomyc);
    $stmt->bindParam(':product_id', $this->product_id);
    $stmt->bindParam(':waranty', $this->waranty);
    $stmt->bindParam(':phone', $this->phone);
    $stmt->bindParam(':date_receipt', $this->date_receipt);
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
}
