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
        $query = 'SELECT
            id, 
            name,
            created_at,
            updated_at
        FROM '. $this->table .'
        WHERE id = :id';

        $statement = $this->connect->prepare($query);
        $statement->bindParam(':id', $this->id);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $this->name = $row['name'];
        $this->created_at = $row['created_at'];
        $this->updated_at = $row['updated_at'];
    }

    public function create() {

    }

    public function update() {

    }

    public function delete() {

    }
}