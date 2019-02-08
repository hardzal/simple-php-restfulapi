<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Acesss-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allo-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->id = $data->id;

// Error while set the same username with others
if($user->delete()) {
    print_r(json_encode(
        array('message' => 'User deleted')
    ));
} else {
    print_r(json_encode(
        array('message' => 'User not deleted')
    ));
}