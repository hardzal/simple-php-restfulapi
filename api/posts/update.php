<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;

$post->user_id = $data->user_id;
$post->category_id = $data->category_id;
$post->title = $data->title;
$post->body = $data->body;

if($post->update()) {
    print_r(json_encode(
        array('message' => 'Post updated')
    ));
} else {
    print_r(json_encode(
        array('message' => 'Post not updated')
    ));
}