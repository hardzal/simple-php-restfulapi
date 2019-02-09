<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->username = $data->username;
$user->password = password_hash($data->password, PASSWORD_DEFAULT);
$user->email = $data->email;
$user->name = $data->name;

if($user->create()) {
    print_r(json_encode(
        array('message' => 'User created')
    ));
} else {
    print_r(json_encode(
        array('message' => 'User not created')
    ));
}
