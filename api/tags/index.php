<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Tag.php';

$database = new Database();
$db = $database->connect();

$tag = new Tag($db);

$result = $tag->index();

$num = $result->rowCount();

if($num > 0) {
    $tags_array = array();
    $tags_array['tags'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $tag_item = array(
            'id' => $id,
            'name' => $name,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );

        array_push($tags_array['tags'], $tag_item);
    }
    http_response_code(200);

    print_r(json_encode($tags_array));
} else {
    http_response_code(404);
    
    print_r(json_encode(
        array('message' => 'No categories found')
    ));
}