<?php

use routes\Product;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../routes/product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$product->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();
$product->readOne();
if ($product->product_name != null) {
  $product_arr = array(
    "product_id" => $product->product_id,
    "product_name" => $product->product_name,
    "product_firm" => $product->product_firm,
    "model" => $product->model,
    "waranty" => $product->waranty,
    "image" => $product->image,
  );
  http_response_code(200);
  echo json_encode($product_arr);
} else {
  http_response_code(404);
  echo json_encode(
    array("message" => "Товар не существует."),
    JSON_UNESCAPED_UNICODE
  );
}
