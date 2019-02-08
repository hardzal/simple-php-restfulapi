<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

$user->id = isset($_GET['id']) ? $_GET['id'] : die();

if($user->show()) {
    $user_array = array(
        'id' => $user->id,
        'username' => $user->username,
        'email' => $user->email,
        'created_at' => $user->created_at,
        'updated_at' => $user->updated_at
    );

    print_r(json_encode($user_array));
} else {
    print_r(json_encode(
        array('message' => 'No user found')
    ));
}