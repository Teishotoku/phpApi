<?php

use routes\Orders;

header("access-control-allow-origin: *");
header("content-type: application/json; charset=utf-8");
header("access-control-allow-methods: POST");
header("access-control-max-age: 3600");
header("access-control-allow-headers: content-type, access-control-allow-headers, authorization, x-requested-with");

$database = new Database();
$db = $database->getConnection();
$orders = new Orders($db);
$data = json_decode(file_get_contents("php://input"));

if (
  !empty($data->order_id) && !empty($data->date)
  && !empty($data->client_first) && !empty($data->client_last)
  && !empty($data->client_patronomyc) && !empty($data->product_id)
  && !empty($data->waranty) && !empty($data->phone)
  && !empty($data->date_receipt)
) {

  $orders->order_id = $data->order_id;
  $orders->date = $data->date;
  $orders->client_first = $data->client_first;
  $orders->client_last = $data->client_last;
  $orders->client_patronomyc = $data->client_patronomyc;
  $orders->product_id = $data->product_id;
  $orders->waranty = $data->waranty;
  $orders->phone = $data->phone;
  $orders->date_receipt = $data->date_receipt;
  /*$orders->created = date("y-m-d h:i:s");*/

  if ($orders->create()) {
    http_response_code(201);
    echo json_encode(
      array("message" => "товар был создан."),
      JSON_UNESCAPED_UNICODE
    );
  } else {
    http_response_code(503);
    echo json_encode(
      array("message" => "невозможно создать товар."),
      JSON_UNESCAPED_UNICODE
    );
  }
} else {
  http_response_code(400);
  echo json_encode(array("message" => "невозможно создать товар. данные неполные", JSON_UNESCAPED_UNICODE));
}
