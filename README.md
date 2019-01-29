# simple-php-restfulapi

##### This repository for learning purpose 

#### CRUD API 
   - Posts
     - **GET** /api/posts/index.php
     - **GET** /api/posts/show.php?id=$id
     - **POST** /api/posts/create.php
     - **PUT** /api/posts/update.php
     - **DELETE** /api/posts/delete.php

   - Categories
     - **GET** /api/categories/index.php
     - **GET** /api/categoris/show.php?id=$id
     - **POST** /api/categories/create.php
     - **PUT** /api/categories/update.php
     - **DELETE** /api/categoris/delete.php

   - Tags
     - **GET** /api/tags/index.php
     - **GET** /api/tags/show.php?id=$id
     - **POST** /api/tags/create.php
     - **PUT** /api/tags/update.php
     - **DELETE** /api/tags/delete.php

   - Posts by Category (one to many)
      - **GET** /api/posts.php?category=$id
  
   - Posts by user (one to many)
      - **GET** /api/posts.php?user=$id
  
   - Posts by tags (many to many)
      - **GET** /api/posts.php?tag=$id 

   - Users
     - **GET** /api/users/index.php
     - **GET** /api/users/show.php?id=$id
     - **POST** /api/users/signup.php
     - **POST** /api/users/login.php
     - **PUT** /api/users/update.php
     - **DELETE** /api/users/delete.php
