<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate Database & Connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$category = new Category($db);

// get id
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// get post
$category->show();

// create array
$category_arr = array(
    'id' => $category->id,
    'name' => $category->name,
    'created_at' => $category->created_at,
    'updated_at' => $category->updated_at
);

print_r(json_encode($category_arr));