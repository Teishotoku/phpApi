<?php
$request = $_SERVER['REQUEST_URI'];
$routerDir = '/routes/';

switch ($request) {
  case '':
  case '/':
    require __DIR__ . $routerDir . 'home.php';
    break;
  case '/employee':
    require __DIR__ . $routerDir . 'employee.php';
    break;
  case '/orders':
    require __DIR__ . $routerDir . 'orders.php';
    break;
  case '/product':
    require __DIR__ . $routerDir . 'product.php';
    break;
  case '/ready':
    require __DIR__ . $routerDir . 'ready.php';
    break;
}
