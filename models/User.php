<?php

class User {

    private $connect;
    private $table = 'users';

    public $id;
    public $username;
    public $email;
    public $name;
    public $created_at;
    public $updated_at;

    public function __construct($connect)
    {
        $this->connect = $connect;   
    }

    public function index() {
        $query = 'SELECT 
            id,
            username,
            name,
            email,
            created_at,
            updated_at 
        FROM '.$this->table.' ORDER BY created_at DESC';

        $statement = $this->connect->prepare($query);
        
        $statement->execute();

        return $statement;
    }

    public function show() {
        
    }
    
    // signup user
    public function create() {

    }

    public function update() {

    }

    public function delete() {

    }

    public function login() {
        
    }

    public function forgotPassword() {

    }
}