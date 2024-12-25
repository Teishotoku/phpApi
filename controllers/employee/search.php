<?php

use routes\Employee;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../routes/employee.php';

$database = new Database();
$db = $database->getConnection();
$employee = new Employee($db);
$keywords = isset($_GET['name']) ? $_GET['name'] : "";
$stmt = $employee->search($keywords);
$num = $stmt->rowCount();
if ($num > 0) {
  $employee_arr = array();
  $employee_arr["records"] = array();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $employee_item = array(
      "employee_id" => $employee_id,
      "employee_first" => $employee_first,
      "employee_last" => $employee_last,
      "employee_post" => $employee_post
    );
    array_push($employee_arr["records"], $employee_item);
  }
  http_response_code(200);
  echo json_encode($employee_arr);
} else {
  http_response_code(404);
  echo json_encode(array("message" => "Сотрудники не найдены."), JSON_UNESCAPED_UNICODE);
}