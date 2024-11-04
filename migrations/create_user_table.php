<?php
    //SQL statement for creating new table
    $statement = "
        CREATE TABLE user (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(64) NOT NULL UNIQUE,
            firstname VARCHAR(64) NOT NULL,
            lastname VARCHAR(64),
            email VARCHAR(255) NOT NULL UNIQUE
        );
    ";

    $pdo = require __DIR__. "/../connection.php";
    $pdo->exec($statement);
?>