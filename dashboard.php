<?php session_start(); //start session?>

<?php
    //require part
    require_once __DIR__. "/inc/functions/Auth/PrevnentNonAuth.php";
?>

<?php
    PreventNonAuth(); //prevent non authenticate users
?>

<?php $title ="dashboard"; require_once __DIR__. "/inc/header.php"; //require header?>
<p>hello <?php echo $_SESSION["username"] ?? "" ?></p>
<?php require_once __DIR__. "/inc/footer.php"; //require footer ?>