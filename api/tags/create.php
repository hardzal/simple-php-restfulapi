<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Tag.php';

$database = new Database();
$db = $database->connect();

$tag = new Tag($db);

$data = json_decode(file_get_contents("php://input"));

$tag->name = $data->name;

if($tag->create()) {
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