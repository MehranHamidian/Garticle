<?php
    $statement = "
        ALTER TABLE user
        ADD COLUMN password VARCHAR(64) NOT NULL;
    ";

    $pdo = require __DIR__. "/../connection.php";
    $pdo->exec($statement);
?>