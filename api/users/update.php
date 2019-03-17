<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Acesss-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allo-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->id = $data->id;
$user->username = $data->username;
$user->password = $data->password;
$user->email = $data->email;
$user->name = $data->name;

// Error while set the same username with others
if($user->update()) {
    print_r(json_encode(
        array('message' => 'User updated')
    ));
} else {
    print_r(json_encode(
        array('message' => 'User not updated')
    ));
}