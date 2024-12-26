<?php

namespace routes;

use PDO;

class Ready
{
  // соединение с БД и таблицей "orders"
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
                order_id, type_repair, cost_repair, date_execution, sms_client, date_receipt, payment
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
                order_id, type_repair, cost_repair, date_execution, sms_client, date_receipt, payment
              FROM 
              " . $this->table_name . "
              WHERE order_id=:order_id";
    $stmt = $this->conn->prepare($query);
    $this->order_id = htmlspecialchars(strip_tags($this->order_id));
    $stmt->bindParam(':order_id', $this->order_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->type_repair = $row['type_repair'];
    $this->cost_repair = $row['cost_repair'];
    $this->date_execution = $row['date_execution'];
    $this->sms_client = $row['sms_client'];
    $this->date_receipt = $row['date_receipt'];
    $this->payment = $row['payment'];
  }

  public function create()
  {
    $query = "INSERT INTO " . $this->table_name . " (order_id, type_repair, cost_repair, date_execution, sms_client, date_receipt, payment) 
        values (:order_id,:type_repair,:cost_repair,:date_execution,:sms_client,:date_receipt,:payment)";
    $stmt = $this->conn->prepare($query);
    $this->order_id = htmlspecialchars(strip_tags($this->order_id));
    $this->type_repair = htmlspecialchars(strip_tags($this->type_repair));
    $this->cost_repair = htmlspecialchars(strip_tags($this->cost_repair));
    $this->date_execution = htmlspecialchars(strip_tags($this->date_execution));
    $this->sms_client = htmlspecialchars(strip_tags($this->sms_client));
    $this->date_receipt = htmlspecialchars(strip_tags($this->date_receipt));
    $this->payment = htmlspecialchars(strip_tags($this->payment));
    $stmt->bindParam(':order_id', $this->order_id);
    $stmt->bindParam(':type_repair', $this->type_repair);
    $stmt->bindParam(':cost_repair', $this->cost_repair);
    $stmt->bindParam(':date_execution', $this->date_execution);
    $stmt->bindParam(':sms_client', $this->sms_client);
    $stmt->bindParam(':date_receipt', $this->date_receipt);
    $stmt->bindParam(':payment', $this->payment);
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  public function update()
  {
    $query = "update " . $this->table_name . " set order_id=:order_id, 
                                                 type_repair=:type_repair,
                                                 cost_repair=:cost_repair,
                                                 date_execution=:date_execution,
                                                 sms_client=:sms_client,
                                                 date_receipt=:date_receipt,
                                                 payment=:payment
                                                 where order_id=:order_id";
    $stmt = $this->conn->prepare($query);
    $this->order_id = htmlspecialchars(strip_tags($this->order_id));
    $this->type_repair = htmlspecialchars(strip_tags($this->type_repair));
    $this->cost_repair = htmlspecialchars(strip_tags($this->cost_repair));
    $this->date_execution = htmlspecialchars(strip_tags($this->date_execution));
    $this->sms_client = htmlspecialchars(strip_tags($this->sms_client));
    $this->date_receipt = htmlspecialchars(strip_tags($this->date_receipt));
    $this->payment = htmlspecialchars(strip_tags($this->payment));

    $stmt->bindParam(':order_id', $this->order_id);
    $stmt->bindParam(':type_repair', $this->type_repair);
    $stmt->bindParam(':cost_repair', $this->cost_repair);
    $stmt->bindParam(':date_execution', $this->date_execution);
    $stmt->bindParam(':sms_client', $this->sms_client);
    $stmt->bindParam(':date_receipt', $this->date_receipt);
    $stmt->bindParam(':payment', $this->payment);

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
    $query = "SELECT * FROM " . $this->table_name . " r 
      WHERE r.type_repair LIKE ? OR r.cost_repair LIKE ? OR 'r.date_execution' LIKE ? OR r.sms_client LIKE ? OR 'r.date_receipt LIKE ? OR payment LIKE ? ORDER BY r.order_id";

    $stmt = $this->conn->prepare($query);
    $keyword = htmlspecialchars(strip_tags($keyword));
    $keyword = "%$keyword%";
    $stmt->bindParam(1, $keyword);
    $stmt->bindParam(2, $keyword);
    $stmt->bindParam(3, $keyword);
    $stmt->bindParam(4, $keyword);
    $stmt->bindParam(5, $keyword);
    $stmt->bindParam(6, $keyword);
    $stmt->execute();
    return $stmt;
  }
}

