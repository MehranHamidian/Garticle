<?php
    $statement = "
        ALTER TABLE user
        ADD COLUMN date_of_register DATE NOT NULL DEFAULT CURRENT_DATE;
    ";

    $pdo = require __DIR__. "/../connection.php";
    $pdo->exec($statement);
?>