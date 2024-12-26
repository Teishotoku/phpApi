<?php

namespace routes;

use PDO;

class Product
{
  // соединение с БД и таблицей "orders"
  private $conn;
  private $table_name = "product";

  // свойства объекта
  public $product_id;
  public $product_name;
  public $product_firm;
  public $model;
  public $waranty;
  public $image;

  public function __construct($db)
  {
    $this->conn = $db;
  }
  public function readAll()
  {
    $query = "SELECT
                product_id, product_name, product_firm, model, waranty, image
            FROM
                " . $this->table_name . "
            ORDER BY
                product_id";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }

  public function readOne(): void
  {
    $query = "SELECT 
                product_id, product_name, product_firm, model, waranty, image
              FROM 
              " . $this->table_name . "
              WHERE product_id=:product_id";
    $stmt = $this->conn->prepare($query);
    $this->product_id = htmlspecialchars(strip_tags($this->product_id));
    $stmt->bindParam(':product_id', $this->product_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->product_name = $row['product_name'];
    $this->product_firm = $row['product_firm'];
    $this->model = $row['model'];
    $this->waranty = $row['waranty'];
    $this->image = $row['image'];
  }

  public function create()
  {
    $query = "insert into " . $this->table_name . " (product_id, product_name, product_firm, model, waranty, image) 
        values (:product_id,:product_name,:product_firm,:model,:waranty,:image)";
    $stmt = $this->conn->prepare($query);
    $this->product_id = htmlspecialchars(strip_tags($this->product_id));
    $this->product_name = htmlspecialchars(strip_tags($this->product_name));
    $this->product_firm = htmlspecialchars(strip_tags($this->product_firm));
    $this->model = htmlspecialchars(strip_tags($this->model));
    $this->waranty = htmlspecialchars(strip_tags($this->waranty));
    $this->image = htmlspecialchars(strip_tags($this->image));
    $stmt->bindParam(':product_id', $this->product_id);
    $stmt->bindParam(':product_name', $this->product_name);
    $stmt->bindParam(':product_firm', $this->product_firm);
    $stmt->bindParam(':model', $this->model);
    $stmt->bindParam(':waranty', $this->waranty);
    $stmt->bindParam(':image', $this->image);
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  public function update()
  {
    $query = "update " . $this->table_name . " set product_id=:product_id, 
                                                 product_name=:product_name,
                                                 product_firm=:product_firm,
                                                 model=:model,
                                                 waranty=:waranty,
                                                 image=:image
                                                 where product_id=:product_id";
    $stmt = $this->conn->prepare($query);
    $this->product_id = htmlspecialchars(strip_tags($this->product_id));
    $this->product_name = htmlspecialchars(strip_tags($this->product_name));
    $this->product_firm = htmlspecialchars(strip_tags($this->product_firm));
    $this->model = htmlspecialchars(strip_tags($this->model));
    $this->waranty = htmlspecialchars(strip_tags($this->waranty));
    $this->image = htmlspecialchars(strip_tags($this->image));

    $stmt->bindParam(':product_id', $this->product_id);
    $stmt->bindParam(':product_name', $this->product_name);
    $stmt->bindParam(':product_firm', $this->product_firm);
    $stmt->bindParam(':model', $this->model);
    $stmt->bindParam(':waranty', $this->waranty);
    $stmt->bindParam(':image', $this->image);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
  public function delete()
  {
    $query = "delete from " . $this->table_name . " where product_id=:product_id";
    $stmt = $this->conn->prepare($query);
    $this->product_id = htmlspecialchars(strip_tags($this->product_id));
    $stmt->bindParam(':product_id', $this->product_id);
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
  public function search($keyword)
  {
    $query = "SELECT * FROM " . $this->table_name . " p 
      WHERE p.product_name LIKE ? OR p.product_firm LIKE ? OR p.model LIKE ? OR p.image LIKE ? ORDER BY p.product_id";

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
