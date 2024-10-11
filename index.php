<?php
require_once __DIR__ . '/vendor/autoload.php';

// $routes = [
//     '/' => 'homePage.php',
//     '/login' => 'userLog-in.php',
//     '/signup' => 'userSign-in.php',
//     '/bookDetails' => 'bookDetails.php',
//     '/addBook' => 'addBook.php',
//     '/editBook' => 'editBook.php',

// ];
// $requestUri = $_SERVER['REQUEST_URI'];
// $urlwq = strtok($requestUri, '?');

// $parts = explode('/', trim($urlwq, '/'));
// $basePath = '/' . $parts[0];

// $id = null;
// if (isset($parts[1]) && is_numeric($parts[1])) {
//     $id = $parts[1];
// }

// if (array_key_exists($basePath, $routes)) {
//     $view = $routes[$basePath];
//     if ($id !== null) {
//         $_GET['id'] = $id;
//     }

//     include __DIR__ . '/app/src/view/' . $view;
// } else {

//     include __DIR__ . '/app/src/view/404page.php';
// }
