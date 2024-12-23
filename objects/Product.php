<?php

namespace objects;

use PDO;

class Product
{
  private $conn;
  private $table_name = 'product';

  public $product_id;
  public $product_name;
  public $product_firm;
  public $model;
  public $specifications;
  public $waranty;
  public $image;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function readAll()
  {
    $query = "SELECT
                product_id, product_name, product_firm, model, specifications, waranty, image
            FROM
                " . $this->table_name . "
            ORDER BY
                order_id";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }
  public function read()
  {
    $query = "select c.category_name,p.product_id,p.product_name,p.description,c.category_id,
	            p.price,p.created from " . $this->table_name . " p left join category c 
                on p.category_id = c.category_id 
                order by p.created desc";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }
  public function create()
  {
    $query = "insert into " . $this->table_name . " (category_id,product_name,description,price,created) 
        values (:category_id,:product_name,:description,:price,:created)";
    $stmt = $this->conn->prepare($query);
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    $this->product_name = htmlspecialchars(strip_tags($this->product_name));
    $this->description = htmlspecialchars(strip_tags($this->description));
    $this->price = htmlspecialchars(strip_tags($this->price));
    $this->created = htmlspecialchars(strip_tags($this->created));
    $stmt->bindParam(':category_id', $this->category_id);
    $stmt->bindParam(':product_name', $this->product_name);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':price', $this->price);
    $stmt->bindParam(':created', $this->created);
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
  public function readOne()
  {
    $query = "select c.category_name,p.product_id,p.product_name,p.description,c.category_id,
        p.price,p.created from " . $this->table_name . " p left join category c
        on p.category_id = c.category_id
        where p.product_id = :product_id";
    $stmt = $this->conn->prepare($query);
    $this->product_id = htmlspecialchars(strip_tags($this->product_id));
    $stmt->bindParam(':product_id', $this->product_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->product_name = $row['product_name'];
    $this->category_id = $row['category_id'];
    $this->product_id = $row['product_id'];
    $this->description = $row['description'];
    $this->price = $row['price'];
    $this->created = $row['created'];
  }

  function update()
  {
    $query = "update " . $this->table_name . " set product_name=:product_name,
                                                 description=:description,
                                                 price=:price,
                                                 category_id=:category_id
                                                 where product_id=:product_id";
    $stmt = $this->conn->prepare($query);
    $this->product_name = htmlspecialchars(strip_tags($this->product_name));
    $this->price = htmlspecialchars(strip_tags($this->price));
    $this->description = htmlspecialchars(strip_tags($this->description));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    $this->product_id = htmlspecialchars(strip_tags($this->product_id));

    $stmt->bindParam(':product_name', $this->product_name);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':price', $this->price);
    $stmt->bindParam(':category_id', $this->category_id);
    $stmt->bindParam(':product_id', $this->product_id);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
  function delete()
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
  function search($keyword)
  {
    $query = "select p.product_name,p.description,p.price,c.category_name
                from " . $this->table_name . " p join category c 
                on p.category_id =c.category_id
                where p.product_name like ? or p.description like ? or c.category_name like ? order by p.description";

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
