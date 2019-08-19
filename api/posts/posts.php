<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
require_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

if (isset($_GET)) {

    if (isset($_GET['category']) && !empty($_GET['category'])) {
        $post->category_id = $_GET['category'];

        $result = $post->show_posts_by_category();
        $num = $result->rowCount();

        if ($num > 0) {
            $posts_array = array();
            $posts_array['posts'] = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $post_item = array(
                    'id' => $id,
                    'title' => $title,
                    'body' => html_entity_decode($body),
                    'user_id' => $user_id,
                    'username' => $username,
                    'category_id' => $category_id,
                    'category_name' => $category_name,
                    'tags' => [
                        //$tag_id => $tag_name
                    ],
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
    } else if (isset($_GET['user']) && !empty($_GET['user'])) {
        $post->user_id = $_GET['user'];

        $result = $post->show_posts_by_user();
        $num = $result->rowCount();

        if ($num > 0) {
            $posts_array = array();
            $posts_array['posts'] = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $post_item = array(
                    'id' => $id,
                    'title' => $title,
                    'body' => html_entity_decode($body),
                    'user_id' => $user_id,
                    'username' => $username,
                    'category_id' => $category_id,
                    'category_name' => $category_name,
                    'tags' => [
                        //  $tag_id => $tag_name
                    ],
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
    } else if (isset($_GET['tag']) && !empty($_GET['tag'])) {
        $post->tag_id = $_GET['tag'];

        $result = $post->show_posts_by_tag();
        $num = $result->rowCount();

        if ($num > 0) {
            $posts_array = array();
            $posts_array['posts'] = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $post_item = array(
                    'id' => $id,
                    'title' => $title,
                    'body' => html_entity_decode($body),
                    'user_id' => $user_id,
                    'username' => $username,
                    'category_id' => $category_id,
                    'category_name' => $category_name,
                    'tag_name' => $tag_name,
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
    } else {
        print_r(json_encode(
            array('message' => 'Provide an id')
        ));
    }
} else {
    $result = $post->index();

    $num = $result->rowCount();

    if ($num > 0) {
        $posts_array = array();
        $posts_array['posts'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

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
}
