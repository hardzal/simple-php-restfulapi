<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Tag.php';

// Instantiate Database & Connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$tag = new Tag($db);

// get id
$tag->id = isset($_GET['id']) ? $_GET['id'] : die();

// get post
$tag->show();

// create array
$tag_array = array(
    'id' => $tag->id,
    'name' => $tag->name,
    'created_at' => $tag->created_at,
    'updated_at' => $tag->updated_at
);

print_r(json_encode($tag_array));