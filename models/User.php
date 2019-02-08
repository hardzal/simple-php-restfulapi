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
        $query = 'SELECT 
            id,
            username,
            name,
            email,
            created_at,
            updated_at
        FROM '. $this->table .'
        WHERE id = ?
        LIMIT 0,1';

        $statement = $this->connect->prepare($query);

        $statement->bindParam(1, $this->id);

        $statement->execute();
        
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($statement->rowCount() > 0) {
            $this->username = $row['username'];
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
            return true;
        } else {
            return false;
        }    
    }
    
    // signup user
    public function create() {

    }

    public function update() {
        $query = 'UPDATE '. $this->table .'
            SET
                username = :username,
                name = :name,
                email = :email
            WHERE
                id = :id';
        
        $statement = $this->connect->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $statement->bindParam(':username', $this->username);
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':id', $this->id);

        if($statement->execute()) {
            return true;
        }

        printf("Erorr : %s.\n", $statement->error);

        return false;
    }

    public function delete() {

    }

    public function login() {
        
    }

    public function forgotPassword() {

    }
}