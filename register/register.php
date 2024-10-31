<?php 
    //start session
    if(!isset($_SESSION)){
        session_start();
    }
?>
<?php 
    $title = "register";
    require_once __DIR__. "/../inc/header.php";
?>
<?php
    $errors = [];
    $inputs = [];
    $method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($method === "GET"){
        $_SESSION["token"] = md5(uniqid(mt_rand(), true));
        require __DIR__ . "/RegisterForm.php";
    }elseif($method === "POST"){
        require __DIR__ . "/RegisterStore.php";
    }
    if(count($errors) > 0){
        include __DIR__. "/RegisterForm.php";
    }
?>
<?php require_once __DIR__. "/../inc/footer.php"?>