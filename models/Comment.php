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
        $query = 'INSERT INTO '. $this->table .'
            SET 
                post_id = :post_id,
                user_id = :user_id,
                comment = :comment';

        $statement = $this->connect->prepare($query);
        
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->post_id = htmlspecialchars(strip_tags($this->post_id));
        $this->body = htmlspecialchars(strip_tags($this->body));

        $statement->bindParam(':user_id', $this->user_id);
        $statement->bindParam(':post_id', $this->post_id);
        $statement->bindParam(':comment', $this->body);
        
        if($statement->execute()) {
            return true;
        }

        printf("Error: %s.\n", $statement->error);

        return false;
    }

    public function update() 
    {
        $query = 'UPDATE '. $this->table .'
            SET
                comment = :comment,
                updated_at = now()
            WHERE 
                id = :id';

        $statement = $this->connect->prepare($query);
        
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $statement->bindParam(':id', $this->id);
        $statement->bindParam(':comment', $this->body);

        if($statement->execute()) {
            return true;
        }        
        
        printf("Error : %s.\n", $statement->error);

        return false;
    }

    public function delete() 
    {

    }
}