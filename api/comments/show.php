<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
require_once '../../models/Comment.php';

$database = new Database();
$db = $database->connect();

$comment = new Comment($db);

$comment->id = isset($_GET['id']) ? $_GET['id'] : die();

$comment->show();

$comment_array = array(
    'id' => $comment->id,
    'post_id' => $comment->post_id,
    'user_id' => $comment->user_id,
    'username' => $comment->username,
    'comment' => $comment->body,
    'created_at' => $comment->created_at,
    'updated_at' => $comment->updated_at
);

print_r(json_encode($comment_array));
