<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Comment.php';

$database = new Database();
$db = $database->connect();

$comment = new Comment($db);

$data = json_decode(file_get_contents("php://input"));

$comment->user_id = $data->user_id;
$comment->post_id = $data->post_id;
$comment->body = $data->comment;

if($comment->create()) {
    print_r(json_encode(
        array('message' => 'Comment created')
    ));
} else {
    print_r(json_encode(
        array('message' => 'Comment not created')
    ));
}
