<?php

use objects\Orders;

header("access-control-allow-origin: *");
header("content-type: application/json; charset=utf-8");
header("access-control-allow-methods: POST");
header("access-control-max-age: 3600");
header("access-control-allow-headers: content-type, access-control-allow-headers, authorization, x-requested-with");

include_once '../../config/database.php';
include_once '../../objects/Orders.php';
$database = new Database();
$db = $database->getConnection();
$orders = new Orders($db);
$data = json_decode(file_get_contents("php://input"));

if (
  !empty($data->product_name) && !empty($data->description)
  && !empty($data->price) && !empty($data->category_id)
) {

  $orders->order_id = $data->product_name;
  $orders->date = $data->date;
  $orders->client_first = $data->client_first;
  $orders->client_last = $data->client_last;
  $orders->product_id = $data->client_patronomyc;
  $orders->product_id = $data->product_id;
  $orders->waranty = $data->waranty;
  $orders->phone = $data->phone;
  $orders->date_receipt = $data->date_receipt;
  /*$orders->created = date("y-m-d h:i:s");*/

  if ($orders->create()) {
    http_response_code(201);
    echo json_encode(
      array("message" => "товар был создан."),
      json_unescaped_unicode
    );
  } else {
    http_response_code(503);
    echo json_encode(
      array("message" => "невозможно создать товар."),
      json_unescaped_unicode
    );
  }
} else {
  http_response_code(400);
  echo json_encode(array("message" => "невозможно создать товар.данные неполные", json_unescaped_unicode));
}
