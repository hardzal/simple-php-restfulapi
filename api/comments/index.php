<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Comment.php';

$database = new Database();
$db = $database->connect();

$comment = new Comment($db);

if (isset($_GET) && !empty($_GET)) {
    if (isset($_GET['post'])) {
        $post_id = isset($_GET['post']) ? $_GET['post'] : null;
        $type = 'post';
        if (isset($_GET['user'])) {
            $user_id = isset($_GET['user']) ? $_GET['user'] : null;
            $type = 'post_user';
        } else {
            $user_id = null;
        }
    } else if (isset($_GET['user'])) {
        $user_id = isset($_GET['user']) ? $_GET['user'] : null;
        $post_id = null;
        $type = 'user';
    }
} else {
    $user_id = null;
    $post_id = null;
    $type = null;
}

$result = $comment->index($post_id, $user_id, $type);
$num = $result->rowCount();

if ($num > 0) {
    $comments_array = array();
    $comments_array['comments'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $comment_item = array(
            'id' => $id,
            'post_id' => $post_id,
            'username' => $username,
            'comment' => $comment,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );

        array_push($comments_array['comments'], $comment_item);
    }
    print_r(json_encode($comments_array));
} else {
    print_r(json_encode(
        array('message' => 'No comments found')
    ));
}
