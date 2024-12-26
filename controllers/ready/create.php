<?php

use routes\Ready;

header("access-control-allow-origin: *");
header("content-type: application/json; charset=utf-8");
header("access-control-allow-methods: POST");
header("access-control-max-age: 3600");
header("access-control-allow-headers: content-type, access-control-allow-headers, authorization, x-requested-with");

$database = new Database();
$db = $database->getConnection();
$ready = new Ready($db);
$data = json_decode(file_get_contents("php://input"));

if (
  !empty($data->order_id) && !empty($data->type_repair)
  && !empty($data->cost_repair) && !empty($data->date_execution)
  && !empty($data->sms_client) && !empty($data->date_receipt)
  && !empty($data->payment)
) {

  $ready->order_id = $data->order_id;
  $ready->type_repair = $data->type_repair;
  $ready->cost_repair = $data->cost_repair;
  $ready->date_execution = $data->date_execution;
  $ready->sms_client = $data->sms_client;
  $ready->date_receipt = $data->date_receipt;
  $ready->payment = $data->payment;
  if ($ready->create()) {
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
