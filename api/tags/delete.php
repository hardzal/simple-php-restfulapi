<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Tag.php';

$database = new Database();
$db = $database->connect();

$tag = new Tag($db);

$data = json_decode(file_get_contents("php://input"));

$tag->id = $data->id;

if($tag->delete()) {
    print_r(json_encode(
        array('message' => 'Tag deleted')
    ));
} else {
    print_r(json_encode(
        array('message' => 'Tag not deleted')
    ));
}