<?php

use routes\Orders;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../routes/orders.php';

$database = new Database();
$db = $database->getConnection();
$orders = new Orders($db);

$orders->order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die();
$orders->readOne();
if ($orders->client_first != null) {
  $orders_arr = array(
    "order_id" => $orders->order_id,
    "date" => $orders->date,
    "client_first" => $orders->client_first,
    "client_last" => $orders->client_last,
    "client_patronomyc" => $orders->client_patronomyc,
    "product_id" => $orders->product_id,
    "waranty" => $orders->waranty,
    "phone" => $orders->phone,
    "date_receipt" => $orders->date_receipt,
  );
  http_response_code(200);
  echo json_encode($orders_arr);
} else {
  http_response_code(404);
  echo json_encode(
    array("message" => "Товар не существует."),
    JSON_UNESCAPED_UNICODE
  );
}
