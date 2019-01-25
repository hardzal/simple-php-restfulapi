<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));

// set category id
$category->id = $data->id;

// set new category name
$category->name = $data->name;

if($category->update()) {
    print_r(json_encode(
        array('message' => 'Category updated')
    ));
} else {
    print_r(json_encode(
        array('message' => 'Category not updated')
    ));
}