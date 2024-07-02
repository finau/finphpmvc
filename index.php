<?php
/**
 * This is the entry point of the application
 * It works like the site main controller which pass the request
 * down to individual controllers to process.
 */

require "controllers/UserController.php";
require "config.php";
require "db/database.php";


/** @var array $config */
$database = new Database($config['database']);
$request = [];

$request_type = $_SERVER['REQUEST_METHOD'];

if ($request_type == 'GET') {
    $request = $_GET;
}
if ($request_type == 'POST') {
    $request = $_POST;
}

$controller = new UserController($request, $database->getConnection(), $config);
$controller->process();
