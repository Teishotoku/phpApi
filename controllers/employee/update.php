<?php

use routes\Employee;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$database = new Database();
$db = $database->getConnection();
$employee = new Employee($db);
$data = json_decode(file_get_contents("php://input"));
$employee->employee_id = $data->employee_id;
$employee->employee_first = $data->employee_first;
$employee->employee_last = $data->employee_last;
$employee->employee_post = $data->employee_post;
if ($employee->update()) {
  http_response_code(200);
  echo json_encode(
    array("message" => "Сотрудник обновлен."),
    JSON_UNESCAPED_UNICODE
  );
} else {
  http_response_code(583);
  echo json_encode(
    array("message" => "Невозможно обновить сотрудника."),
    JSON_UNESCAPED_UNICODE
  );
}
