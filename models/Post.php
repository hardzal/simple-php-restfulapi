<?php

class Post {
    // properties    
   
    // properties database
    private $connect;
    private $table = 'posts';

    // attributes table
    public $id;
    public $category_id;
    public $category_name;
    public $tile;
    public $body;
    public $user_id;
    public $user_name;
    public $created_at;

    public function __construct($db_connection)
    {
        $this->connect = $db_connection;
    }

    public function index() {
        $query = 'SELECT 
                c.name as category_name,
                u.username,
                p.id, 
                p.category_id,
                p.user_id,
                p.title,
                p.body,
                p.created_at,
                p.updated_at
            FROM
                '. $this->table .' p
            LEFT JOIN 
                categories c ON p.category_id = c.id
            LEFT JOIN
                users u ON p.user_id = u.id
            ORDER BY 
                p.created_at DESC';

        $statement = $this->connect->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function show() {

    }

    public function update() {

    }

    public function delete() {

    }
}