<?php

use routes\Product;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$data = json_decode(file_get_contents("php://input"));

if (
  !empty($data->product_id) && !empty($data->product_name)
  && !empty($data->product_firm) && !empty($data->model)
  && !empty($data->waranty) && !empty($data->image)
) {
  $product->product_id = $data->product_id;
  $product->product_name = $data->product_name;
  $product->product_firm = $data->product_firm;
  $product->model = $data->model;
  $product->waranty = $data->waranty;
  $product->image = $data->image;

  if ($product->create()) {
    http_response_code(201);
    echo json_encode(
      array("message" => "Продукт был создан."),
      JSON_UNESCAPED_UNICODE
    );
  } else {
    http_response_code(503);
    echo json_encode(
      array("message" => "Невозможно создать товар."),
      JSON_UNESCAPED_UNICODE
    );
  }
} else {
  http_response_code(400);
  echo json_encode(array("message" => "Невозможно создать товар.Данные неполные", JSON_UNESCAPED_UNICODE));
}
