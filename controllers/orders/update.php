<?php

use routes\Orders;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$database = new Database();
$db = $database->getConnection();
$product = new Orders($db);
$data = json_decode(file_get_contents("php://input"));
$product->order_id = $data->order_id;
$product->date = $data->date;
$product->client_first = $data->client_first;
$product->client_last = $data->client_last;
$product->client_patronomyc = $data->client_patronomyc;
$product->product_id = $data->product_id;
$product->waranty = $data->waranty;
$product->phone = $data->phone;
$product->date_receipt = $data->date_receipt;
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

