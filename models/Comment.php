<?php

class Post {
    // properties    
   
    // properties database
    private $connect;
    private $table = 'comments';

    // attributes table
    
    public function __construct($db_connection)
    {
        $this->connect = $db_connection;
    }

}