<?php
    //this function prevent non authenticate users
    function PreventNonAuth(){
        if(!isset($_SESSION["auth"])){
            header("Location:/login.php", true, 301);
            exit;
        }elseif(isset($_SESSION["auth"]) && $_SESSION["auth"] === false){
            header("Location:/login.php", true, 301);
            exit;
        }
    }
?>