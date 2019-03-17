<?php

class Comment {
    // properties    
   
    // properties database
    private $connect;
    private $table = 'comments';

    // attributes table
    
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