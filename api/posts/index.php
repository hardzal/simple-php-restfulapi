<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$result = $post->index();

$num = $result->rowCount();

echo $num;

if($num > 0) {
    $posts_array = array();
    $post_array['posts'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'username' => $username,
            'category_id' => $category_id,
            'category_name' => $category_name,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );

        array_push($post_array['posts'], $post_item);
    }
    echo json_encode($post_array);
} else {
    echo json_encode(
        array('message' => 'No posts found')
    );
}