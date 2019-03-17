<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
require_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

$post->show();

$post_array = array(
    'id' => $post->id,
    'user_id' => $post->user_id,
    'username' => $post->user_name,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name,
    'tag' => [],
    'title' => $post->title,
    'body' => $post->body,
    'created_at' => $post->created_at,
    'updated_at' => $post->updated_at
);

print_r(json_encode($post_array));
