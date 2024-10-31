<?php 
    //start session
    if(!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garticle - Register</title>
</head>
<body>
    <?php

        $errors = [];
        $inputs = [];

        $method = strtoupper($_SERVER["REQUEST_METHOD"]);
        if($method === "GET"){
            $_SESSION["token"] = md5(uniqid(mt_rand(), true));
            include __DIR__ . "/RegisterForm.php";
        }elseif($method === "POST"){
            include __DIR__ . "/RegisterStore.php";
        }

        if(count($errors) > 0){
            include __DIR__. "/RegisterForm.php";
        }

    ?>
</body>
</html>