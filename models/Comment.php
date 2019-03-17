<?php

class Comment {
    // properties    
   
    // properties database
    private $connect;
    private $table = 'comments';

    // attributes table
    public $id;
    public $post_id;
    public $user_id;
    public $body;
    public $created_at;
    public $updated_at;

    public function __construct($db_connection)
    {
        $this->connect = $db_connection;
    }

    public function index() 
    {
        $query = 'SELECT 
            c.id,
            u.username,
            p.id as post_id,
            c.comment,
            c.created_at,
            c.updated_at
        FROM '.$this->table. ' c
        LEFT JOIN
            posts p ON c.post_id=p.id
        LEFT JOIN
            users u ON c.user_id=u.id
        ORDER BY
            c.created_at DESC';

        $statement = $this->connect->prepare($query);

        $statement->execute();
        
        return $statement;
    }

    public function show() 
    {
        $query = 'SELECT 
            c.id,
            p.id as post_id,
            c.user_id,
            u.username,
            c.comment,
            c.created_at,
            c.updated_at
        FROM '.$this->table. ' c
        LEFT JOIN
            posts p ON c.post_id=p.id
        LEFT JOIN
            users u ON c.user_id=u.id
        WHERE
            c.id = ?
        LIMIT 0,1';

        $statement = $this->connect->prepare($query);

        $statement->bindParam(1, $this->id);

        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->post_id = $row['post_id'];
        $this->user_id = $row['user_id'];
        $this->username = $row['username'];
        $this->body = $row['comment'];
        $this->created_at = $row['created_at'];
        $this->updated_at = $row['updated_at'];
    }

    public function create() 
    {

    }

    public function update() 
    {

    }

    public function delete() 
    {

    }
}