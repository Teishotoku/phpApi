<?php

use routes\Employee;

header("access-control-allow-origin: *");
header("content-type: application/json; charset=utf-8");
header("access-control-allow-methods: POST");
header("access-control-max-age: 3600");
header("access-control-allow-headers: content-type, access-control-allow-headers, authorization, x-requested-with");

$database = new Database();
$db = $database->getConnection();
$employee = new Employee($db);
$data = json_decode(file_get_contents("php://input"));

if (
  !empty($data->employee_id) && !empty($data->employee_first)
  && !empty($data->employee_last) && !empty($data->employee_post)
) {

  $employee->employee_id = $data->employee_id;
  $employee->employee_first = $data->employee_first;
  $employee->employee_last = $data->employee_last;
  $employee->employee_post = $data->employee_post;

  if ($employee->create()) {
    http_response_code(201);
    echo json_encode(
      array("message" => "сотрудник добавлен."),
      JSON_UNESCAPED_UNICODE
    );
  } else {
    http_response_code(503);
    echo json_encode(
      array("message" => "невозможно добавить сотрудника."),
      JSON_UNESCAPED_UNICODE
    );
  }
} else {
  http_response_code(400);
  echo json_encode(array("message" => "невозможно добавить сотрудника. данные неполные", JSON_UNESCAPED_UNICODE));
}
