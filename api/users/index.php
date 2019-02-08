<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

$result = $user->index();

$num = $result->rowCount();

if($num > 0) 
{
    $users_array = array();
    $users_array['users'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $user_item = array(
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'name' => $name,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );

        array_push($users_array['users'], $user_item);        
    }

    print_r(json_encode($users_array));
} else 
{
    print_r(json_encode(
        array('message' => 'No users found')
    ));
}