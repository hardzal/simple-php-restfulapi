<?php

class Category {
    
    private $connect;
    private $table = 'categories';

    public $id;
    public $name;
    public $created_at;
    public $updated_at;

    public function __construct($db_connect)
    {
        $this->connect = $db_connect;    
    }

    public function index() {
        $query = 'SELECT
            id, 
            name,
            created_at,
            updated_at
        FROM '. $this->table .'
        ORDER BY created_at DESC';

        $statement = $this->connect->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function show() {

    }

    public function create() {

    }

    public function update() {

    }

    public function delete() {

    }
}