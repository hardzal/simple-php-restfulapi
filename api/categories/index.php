<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

$result = $category->index();

$num = $result->rowCount();

if($num > 0) {
    $categories_array = array();
    $categories_array['categories'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $category_item = array(
            'id' => $id,
            'name' => $name,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );

        array_push($categories_array['categories'], $category_item);
    }
    http_response_code(200);

    print_r(json_encode($categories_array));
} else {
    http_response_code(404);
    
    print_r(json_encode(
        array('message' => 'No categories found')
    ));
}