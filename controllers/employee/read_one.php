<?php

use routes\Employee;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../routes/employee.php';

$database = new Database();
$db = $database->getConnection();
$employee = new Employee($db);

$employee->employee_id = isset($_GET['employee_id']) ? $_GET['employee_id'] : die();
$employee->readOne();
if ($employee->employee_first != null) {
  $employee_arr = array(
    "employee_id" => $employee->employee_id,
    "employee_first" => $employee->employee_first,
    "employee_last" => $employee->employee_last,
    "employee_post" => $employee->employee_post,
  );
  http_response_code(200);
  echo json_encode($employee_arr);
} else {
  http_response_code(404);
  echo json_encode(
    array("message" => "Сотрудник не существует."),
    JSON_UNESCAPED_UNICODE
  );
}
