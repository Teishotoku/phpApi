<?php

use routes\Orders;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../routes/orders.php';

$database = new Database();
$db = $database->getConnection();
$orders = new Orders($db);
$keywords = isset($_GET['name']) ? $_GET['name'] : "";
$stmt = $orders->search($keywords);
$num = $stmt->rowCount();
if ($num > 0) {
  $orders_arr = array();
  $orders_arr["records"] = array();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $orders_item = array(
      "date" => $date,
      "client_first" => $client_first,
      "client_last" => $client_last,
      "category_name" => $client_patronomyc
    );
    array_push($orders_arr["records"], $orders_item);
  }
  http_response_code(200);
  echo json_encode($orders_arr);
} else {
  http_response_code(404);
  echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
}
