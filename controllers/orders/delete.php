<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: delete");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$database = new Database();
$db = $database->getConnection();
$orders = new \routes\Orders($db);
$data = json_decode(file_get_contents("php://input"));
$orders->order_id = $data->order_id;
if ($orders->delete()) {
  http_response_code(200);
  echo json_encode(
    array("message" => "Товар удален."),
    JSON_UNESCAPED_UNICODE
  );
} else {
  http_response_code(503);
  echo json_encode(
    array("message" => "Невозможно удалить товар."),
    JSON_UNESCAPED_UNICODE
  );
}
