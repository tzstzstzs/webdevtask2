<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/login' :
        require 'login.php';
        break;
    // Add more routes as needed
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php'; // Optional: a 404 view
        break;
}
