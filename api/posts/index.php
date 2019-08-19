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

if ($num > 0) {
    $posts_array = array();
    $posts_array['posts'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $tags = array();

        $result_tag = $post->show_all_tag($id);

        $num_tag = $result_tag->rowCount();

        if ($num_tag > 0) {
            while ($tag = $result_tag->fetch(PDO::FETCH_ASSOC)) {
                array_push($tags, $tag['name']);
            }
        }

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'user_id' => $user_id,
            'username' => $username,
            'category_id' => $category_id,
            'category_name' => $category_name,
            'tags' => $tags,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );

        array_push($posts_array['posts'], $post_item);
    }
    print_r(json_encode($posts_array));
} else {
    print_r(json_encode(
        array('message' => 'No posts found')
    ));
}
