<?php

namespace routes;

use PDO;

class Employee
{
  // соединение с БД и таблицей "employee"
  private $conn;
  private $table_name = "employee";

  // свойства объекта
  public $employee_id;
  public $employee_first;
  public $employee_last;
  public $employee_post;

  public function __construct($db)
  {
    $this->conn = $db;
  }
  public function readAll()
  {
    $query = "SELECT
                employee_id, employee_first, employee_last, employee_post
            FROM
                " . $this->table_name . "
            ORDER BY
                employee_id";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }

  public function readOne(): void
  {
    $query = "SELECT 
                 employee_id, employee_first, employee_last, employee_post
              FROM 
              " . $this->table_name . "
              WHERE employee_id=:employee_id";
    $stmt = $this->conn->prepare($query);
    $this->employee_id = htmlspecialchars(strip_tags($this->employee_id));
    $stmt->bindParam(':employee_id', $this->employee_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->employee_first = $row['employee_first'];
    $this->employee_last = $row['employee_last'];
    $this->employee_post = $row['employee_post'];
  }

  public function create(): bool
  {
    $query = "insert into " . $this->table_name . " (employee_id, employee_first, employee_last, employee_post) 
        values (:employee_id,:employee_first,:employee_last,:employee_post)";
    $stmt = $this->conn->prepare($query);
    $this->employee_id = htmlspecialchars(strip_tags($this->employee_id));
    $this->employee_first = htmlspecialchars(strip_tags($this->employee_first));
    $this->employee_last = htmlspecialchars(strip_tags($this->employee_last));
    $this->employee_post = htmlspecialchars(strip_tags($this->employee_post));
    $stmt->bindParam(':employee_id', $this->employee_id);
    $stmt->bindParam(':employee_first', $this->employee_first);
    $stmt->bindParam(':employee_last', $this->employee_last);
    $stmt->bindParam(':employee_post', $this->employee_post);
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  public function update()
  {
    $query = "UPDATE " . $this->table_name . " SET employee_id=:employee_id, 
                                                 employee_first=:employee_first,
                                                 employee_last=:employee_last,
                                                 employee_post=:employee_post
                                                 WHERE employee_id=:employee_id";
    $stmt = $this->conn->prepare($query);
    $this->employee_id = htmlspecialchars(strip_tags($this->employee_id));
    $this->employee_first = htmlspecialchars(strip_tags($this->employee_first));
    $this->employee_last = htmlspecialchars(strip_tags($this->employee_last));
    $this->employee_post = htmlspecialchars(strip_tags($this->employee_post));

    $stmt->bindParam(':employee_id', $this->employee_id);
    $stmt->bindParam(':employee_first', $this->employee_first);
    $stmt->bindParam(':employee_last', $this->employee_last);
    $stmt->bindParam(':employee_post', $this->employee_post);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
  public function delete(): bool
  {
    $query = "DELETE FROM " . $this->table_name . " WHERE employee_id=:employee_id";
    $stmt = $this->conn->prepare($query);
    $this->employee_id = htmlspecialchars(strip_tags($this->employee_id));
    $stmt->bindParam(':employee_id', $this->employee_id);
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
  public function search($keyword)
  {
    $query = "SELECT * FROM " . $this->table_name . " e 
      WHERE e.employee_first LIKE ? or e.employee_last LIKE ? OR e.employee_post LIKE ? ORDER BY e.employee_id";

    $stmt = $this->conn->prepare($query);
    $keyword = htmlspecialchars(strip_tags($keyword));
    $keyword = "%$keyword%";
    $stmt->bindParam(1, $keyword);
    $stmt->bindParam(2, $keyword);
    $stmt->bindParam(3, $keyword);
    $stmt->execute();
    return $stmt;
  }
}
