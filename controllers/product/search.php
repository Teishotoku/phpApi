<?php

use routes\Product;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../routes/product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$keywords = isset($_GET['name']) ? $_GET['name'] : "";
$stmt = $product->search($keywords);
$num = $stmt->rowCount();
if ($num > 0) {
  $products_arr = array();
  $products_arr["records"] = array();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $product_item = array(
      "product_name" => $product_name,
      "product_firm" => $product_firm,
      "model" => $model,
      "image" => $image
    );
    array_push($products_arr["records"], $product_item);
  }
  http_response_code(200);
  echo json_encode($products_arr);
} else {
  http_response_code(404);
  echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
}
