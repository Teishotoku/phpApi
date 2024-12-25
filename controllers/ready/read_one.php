<?php

use routes\Ready;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../routes/ready.php';

$database = new Database();
$db = $database->getConnection();
$ready = new Ready($db);

$ready->order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die();
$ready->readOne();
if ($ready->type_repair != null) {
  $ready_arr = array(
    "order_id" => $ready->order_id,
    "date" => $ready->type_repair,
    "client_first" => $ready->cost_repair,
    "client_last" => $ready->date_execution,
    "client_patronomyc" => $ready->sms_client,
    "product_id" => $ready->date_receipt,
    "date_receipt" => $ready->payment,
  );
  http_response_code(200);
  echo json_encode($ready_arr);
} else {
  http_response_code(404);
  echo json_encode(
    array("message" => "Товар не существует."),
    JSON_UNESCAPED_UNICODE
  );
}
