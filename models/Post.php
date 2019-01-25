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
    public $updated_at;

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
            WHERE 
                p.id = ?
            LIMIT 0,1';

        $statement = $this->connect->prepare($query);

        $statement->bindParam(1, $this->id);

        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->user_name = $row['username'];
        $this->user_id = $row['user_id'];
        $this->category_name = $row['category_name'];
        $this->category_id = $row['category_id'];
        $this->created_at = $row['created_at'];
        $this->updated_at = $row['updated_at'];
    
    }

    public function create() {
        $query = 'INSERT INTO '. $this->table .'
            SET
                user_id = :user_id,
                category_id = :category_id,
                title = :title,
                body = :body';
        
        $statement = $this->connect->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $statement->bindParam(':user_id', $this->user_id);
        $statement->bindParam(':category_id', $this->category_id);
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':body', $this->body);

        if($statement->execute()) {
            return true;
        }

        printf("Error : %s.\n", $statement->error);
        
        return false;
    }

    public function update() {
        // TODO: fix updated_at
        $query = 'UPDATE '. $this->table .'
            SET
                user_id = :user_id,
                category_id = :category_id,  
                title = :title,
                body = :body,
                updated_at = now() 
            WHERE 
                id = :id';
        
        $statement = $this->connect->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $statement->bindParam(':id', $this->id);
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':body', $this->body);
        $statement->bindParam(':user_id', $this->user_id);
        $statement->bindParam('category_id', $this->category_id);

        if($statement->execute()) {
            return true;
        }
        
        printf("Error : %s.\n", $statement->error);

        return false;
    }

    public function delete() {
        $query = 'DELETE FROM '. $this->table . ' WHERE id = :id';

        $statement = $this->connect->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));

        $statement->bindParam(':id', $this->id);

        if($statement->execute()) {
            return true;
        }

        printf("Error : %s.\n", $statement->error);

        return false;
    }
}