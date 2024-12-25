<?php

namespace routes;

use PDO;

class Product
{
  // соединение с БД и таблицей "orders"
  private $conn;
  private $table_name = "product";

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

  public function readOne()
  {
    $query = "SELECT 
                order_id, date, client_first, client_last, client_patronomyc, product_id, waranty, phone, date_receipt
              FROM 
              " . $this->table_name . "
              WHERE order_id=:order_id";
    $stmt = $this->conn->prepare($query);
    $this->order_id = htmlspecialchars(strip_tags($this->order_id));
    $stmt->bindParam(':order_id', $this->order_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->date = $row['date'];
    $this->client_first = $row['client_first'];
    $this->client_last = $row['client_last'];
    $this->client_patronomyc = $row['client_patronomyc'];
    $this->product_id = $row['product_id'];
    $this->waranty = $row['waranty'];
    $this->phone = $row['phone'];
    $this->date_receipt = $row['date_receipt'];
  }

  public function create(): bool
  {
    $query = "insert into " . $this->table_name . " (order_id, date, client_first, client_last, client_patronomyc, product_id, waranty, phone, date_receipt) 
        values (:order_id,:date,:client_first,:client_last,:client_patronomyc,:product_id,:waranty,:phone,:date_receipt)";
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

  public function update()
  {
    $query = "update " . $this->table_name . " set order_id=:order_id, 
                                                 date=:date,
                                                 client_first=:client_first,
                                                 client_last=:client_last,
                                                 client_patronomyc=:client_patronomyc,
                                                 product_id=:product_id,
                                                 waranty=:waranty,
                                                 phone=:phone,
                                                 date_receipt=:date_receipt
                                                 where order_id=:order_id";
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
  public function delete(): bool
  {
    $query = "delete from " . $this->table_name . " where order_id=:order_id";
    $stmt = $this->conn->prepare($query);
    $this->order_id = htmlspecialchars(strip_tags($this->order_id));
    $stmt->bindParam(':order_id', $this->order_id);
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
  public function search($keyword)
  {
    $query = "SELECT * FROM " . $this->table_name . " o 
      WHERE 'o.date' LIKE ? or o.client_first LIKE ? OR o.client_last LIKE ? OR o.client_patronomyc LIKE ? ORDER BY o.order_id";

    $stmt = $this->conn->prepare($query);
    $keyword = htmlspecialchars(strip_tags($keyword));
    $keyword = "%$keyword%";
    $stmt->bindParam(1, $keyword);
    $stmt->bindParam(2, $keyword);
    $stmt->bindParam(3, $keyword);
    $stmt->bindParam(4, $keyword);
    $stmt->execute();
    return $stmt;
  }
}
