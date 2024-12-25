<?php

use routes\Ready;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$database = new Database();
$db = $database->getConnection();
$ready = new Ready($db);
$data = json_decode(file_get_contents("php://input"));
$ready->order_id = $data->order_id;
$ready->type_repair = $data->type_repair;
$ready->cost_repair = $data->cost_repair;
$ready->date_execution = $data->date_execution;
$ready->sms_client = $data->sms_client;
$ready->date_receipt = $data->date_receipt;
$ready->payment = $data->payment;
if ($ready->update()) {
  http_response_code(200);
  echo json_encode(
    array("message" => "Заказ обновлен."),
    JSON_UNESCAPED_UNICODE
  );
} else {
  http_response_code(583);
  echo json_encode(
    array("message" => "Невозможно обновить заказ."),
    JSON_UNESCAPED_UNICODE
  );
}
