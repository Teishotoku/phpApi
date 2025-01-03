<?php

use routes\Product;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$data = json_decode(file_get_contents("php://input"));
$product->product_id = $data->product_id;
$product->product_name = $data->product_name;
$product->product_firm = $data->product_firm;
$product->model = $data->model;
$product->waranty = $data->waranty;
$product->image = $data->image;
if ($product->update()) {
  http_response_code(200);
  echo json_encode(
    array("message" => "Товар обновлен."),
    JSON_UNESCAPED_UNICODE
  );
} else {
  http_response_code(583);
  echo json_encode(
    array("message" => "Невозможно обновить товар."),
    JSON_UNESCAPED_UNICODE
  );
}
