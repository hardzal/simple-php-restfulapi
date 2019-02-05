<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Tag.php';

$database = new Database();
$db = $database->connect();

$tag = new Tag($db);

$data = json_decode(file_get_contents("php://input"));

// set category id
$tag->id = $data->id;

// set new category name
$tag->name = $data->name;

if($tag->update()) {
    print_r(json_encode(
        array('message' => 'Category updated')
    ));
} else {
    print_r(json_encode(
        array('message' => 'Category not updated')
    ));
}