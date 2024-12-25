<?php
$request = $_SERVER['REQUEST_URI'];
$employeeRoute = '/controllers/employee/';
$ordersRoute = '/controllers/orders/';
$productRoute = '/controllers/product/';
$readyRoute = '/controllers/ready/';

include_once './config/database.php';
include_once './routes/orders.php';
include_once './routes/employee.php';
include_once './routes/ready.php';

switch ($request) {
  case '':
  case '/':
    require __DIR__ . './routes/' . 'home.php';
    break;

    // ORDER ROUTE
  case '/orders':
    require __DIR__ . $ordersRoute . 'read.php';
    break;
  case '/orders/one':
    require __DIR__ . $ordersRoute . 'read_one.php';
    break;
  case '/orders/create':
    require __DIR__ . $ordersRoute . 'create.php';
    break;
  case '/orders/update':
    require __DIR__ . $ordersRoute . 'update.php';
    break;
  case '/orders/delete':
    require __DIR__ . $ordersRoute . 'delete.php';
    break;
  case '/orders/search':
    require __DIR__ . $ordersRoute . 'search.php';
    break;

    // EMPLOYEE ROUTE
  case '/employee':
    require __DIR__ . $employeeRoute . 'read.php';
    break;
  case '/employee/create':
    require __DIR__ . $employeeRoute . 'create.php';
    break;
  case '/employee/update':
    require __DIR__ . $employeeRoute . 'update.php';
    break;
  case '/employee/delete':
    require __DIR__ . $employeeRoute . 'delete.php';
    break;

    // PRODUCT ROUTE
  case '/product':
    require __DIR__ . $productRoute . 'read.php';
    break;
  case '/product/create':
    require __DIR__ . $productRoute . 'create.php';
    break;
  case '/product/update':
    require __DIR__ . $productRoute . 'update.php';
    break;
  case '/product/delete':
    require __DIR__ . $productRoute . 'delete.php';
    break;

    // READY ROUTE
  case '/ready':
    require __DIR__ . $readyRoute . 'read.php';
    break;
  case '/ready/create':
    require __DIR__ . $readyRoute . 'create.php';
    break;
  case '/ready/update':
    require __DIR__ . $readyRoute . 'update.php';
    break;
  case '/ready/delete':
    require __DIR__ . $readyRoute . 'delete.php';
    break;
}
