<?php

use routes\Orders;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$database = new Database();
$db = $database->getConnection();
$orders = new Orders($db);
$stmt = $orders->readAll();
$num = $stmt->rowCount();
if ($num > 0) {
  $orders_arr = array();
  $orders_arr["records"] = array();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $orders_item = array(
      "order_id" => $order_id,
      "date" => $date,
      "client_first" => $client_first,
      "client_last" => $client_last,
      "client_patronomyc" => $client_patronomyc,
      "product_id" => $product_id,
      "waranty" => $waranty,
      "phone" => $phone,
      "date_receipt" => $date_receipt
    );
    $orders_arr["records"][] = $orders_item;
  }
  http_response_code(200);
  echo json_encode($orders_arr);
} else {
  http_response_code(404);
  echo json_encode(
    array("message" => "Товары не найдены."),
    JSON_UNESCAPED_UNICODE
  );
}
