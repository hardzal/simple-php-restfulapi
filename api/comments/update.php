<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Comment.php';

$database = new Database();
$db = $database->connect();

$comment = new Comment($db);

$data = json_decode(file_get_contents("php://input"));

$comment->id = $data->id;
$comment->body = $data->comment;

if($comment->update()) {
    print_r(json_encode(
        array('message' => 'Comment updated')
    ));
} else {
    print_r(json_encode(
        array('message' => 'Comment not updated')
    ));
};