<?php

require_once "DbConnection.php";

$sql ="CREATE TABLE IF NOT EXISTS `users` (
    `id` INT PRIMARY KEY AUTO_INCREMENT UNSIGNED,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) UNIQUE NOT NULL,
    `about` VARCHAR(255),
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `photo_path` VARCHAR(255),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
) ENGINE = InnoDB;";


$sql ="CREATE TABLE IF NOT EXISTS `visitors` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
) ENGINE = InnoDB;";



$sql ="CREATE TABLE IF NOT EXISTS `posts` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT,
    `title` VARCHAR(255),
    `text` TEXT,
    `tag` VARCHAR(255) ,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) 
    ON UPDATE CASCADE ON DELETE CASCADE
    
) ENGINE = InnoDB;";

$sql ="CREATE TABLE IF NOT EXISTS `images` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT ,
    `post_id`  INT ,
    `image_path` VARCHAR(255),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
    
) ENGINE = InnoDB;";


$sql ="CREATE TABLE IF NOT EXISTS `comments` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT ,
    `visitor_id` INT ,
    `post_id` INT ,
    `text` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

     FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
     FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`) ON DELETE CASCADE,
     FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
    
) ENGINE = InnoDB;";


$sql = "CREATE TABLE IF NOT EXISTS `ratings` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT,
    `post_id` INT,
    `mark` BOOLEAN,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE

) ENGINE = InnoDB;";




if($connection->getConnection()->multi_query($sql)){
    echo 'Tables created successfully';
}else{
    header('location:index.php');
}