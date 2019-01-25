<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate Database & Connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// get row posted data
$data = json_decode(file_get_contents("php://input"));

// set ID to delete
$post->id = $data->id;

// delete post
if($post->delete()) {
    echo json_encode(
        array('message' => 'Post deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post not deteled')
    );
}