<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));

$category->name = $data->name;

if($category->create()) {
    http_response_code(201);

    print_r(json_encode(
        array('message' => 'Category created')
    ));
} else {
    http_response_code(503);
    
    print_r(json_encode(
        array('message' => 'Category not created')
    ));
}