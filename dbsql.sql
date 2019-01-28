CREATE DATABASE IF NOT EXISTS latihan_api_crud;
USE latihan_api_crud;

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `posts` (
  `id` int(11) PRIMARY KEY NOT NULL UNSIGNED AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `users` (
  `id` int(11) PRIMARY KEY NOT NULL UNSIGNED AUTO_INCREMENT,
  `username` varchar(255) NOT NULL UNIQUE,
  `email` varchar(255) NOT NULL UNIQUE,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO categories 
	VALUES 
    	('', 'Technology', now(), ''),
        ('', 'Learning', now(), ''),
        ('', 'Artificial Intelegence', now(), ''),
        ('', 'Social Media', now(), ''),
        ('', 'Internet', now(), ''),
        ('', 'Science', now(), ''),
        ('', 'Mathematic', now(), '');
        
CREATE TABLE tags (
  `id` int(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,  
   `name` VARCHAR(255) NOT NULL,
   `created_at` timestamp,
   `updated_at` timestamp
);
