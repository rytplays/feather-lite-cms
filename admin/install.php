<?php
require_once("../config.php");

#create posts table
try
{
    $pdo->query
    (
        "CREATE TABLE `".POSTS_TABLE."`
        (
            `post_id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            `post_slug` VARCHAR(100) NOT NULL UNIQUE,
            `post_status` CHAR(1) NOT NULL DEFAULT 'D',
            `post_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `post_title` TEXT,
            `post_desc` TEXT,
            `post_content` MEDIUMTEXT,
            `post_meta` TEXT
        )
        DEFAULT CHARSET=utf8mb4
        COLLATE=utf8mb4_unicode_ci;"
    );
    echo "POSTS TABLE CREATED SUCCESSFULLY<br>";
}
catch(PDOException $e){echo $e->getMessage()."<br>";}

#create tags table
try
{
    $pdo->query
    (
        "CREATE TABLE `".TAGS_TABLE."`
        (
            `tag_id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            `tag_slug` VARCHAR(50) NOT NULL UNIQUE,
            `tag_name` TEXT
        )
        DEFAULT CHARSET=utf8mb4
        COLLATE=utf8mb4_unicode_ci;"
    );
    echo 'TAGS TABLE CREATED SUCCESSFULLY<br>';
}
catch(Exception $e){echo $e->getMessage().'<br>';}


#create post_tag table
try
{
    $pdo->query
    (
        "CREATE TABLE `".POST_TAG_TABLE."`
        (
            `post_id` INT UNSIGNED NOT NULL,
            `tag_id` INT UNSIGNED NOT NULL,
            PRIMARY KEY(`tag_id`,`post_id`),
            FOREIGN KEY (`tag_id`) REFERENCES `".TAGS_TABLE."`(`tag_id`) ON DELETE CASCADE,
            FOREIGN KEY (`post_id`) REFERENCES `".POSTS_TABLE."`(`post_id`) ON DELETE CASCADE
        )
        DEFAULT CHARSET=utf8mb4
        COLLATE=utf8mb4_unicode_ci;"
    );
    echo 'TAG POST RELATION TABLE CREATED SUCCESSFULLY<br>';
}
catch(Exception $e){echo($e->getMessage()).'<br>';}

?>