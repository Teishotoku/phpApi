<?php

use routes\Ready;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$database = new Database();
$db = $database->getConnection();
$ready = new Ready($db);
$stmt = $ready->readAll();
$num = $stmt->rowCount();
if ($num > 0) {
  $ready_arr = array();
  $ready_arr["records"] = array();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $ready_item = array(
      "order_id" => $order_id,
      "type_repair" => $type_repair,
      "cost_repair" => $cost_repair,
      "date_execution" => $date_execution,
      "sms_client" => $sms_client,
      "date_receipt" => $date_receipt,
      "payment" => $payment,
    );
    $ready_arr["records"][] = $ready_item;
  }
  http_response_code(200);
  echo json_encode($ready_arr);
} else {
  http_response_code(404);
  echo json_encode(
    array("message" => "Товары не найдены."),
    JSON_UNESCAPED_UNICODE
  );
}
