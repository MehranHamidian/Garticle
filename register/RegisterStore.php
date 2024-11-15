<?php
    $pdo = require_once __DIR__. "/../connection.php"; //for connection to database
    require_once __DIR__. "/../inc/functions/DB/ExistInDB.php"; //for check value in database
    require_once __DIR__. "/../inc/functions/validate/validate_username.php"; //for validate username
    require_once __DIR__. "/../inc/functions/validate/validate_name.php"; //for validate names
?>
<?php

    //first of all validate token
    $token = htmlspecialchars( filter_input(INPUT_POST, "RegisterToken"));
    if(!$token || $token !== $_SESSION["token"]){
        header($_SERVER["SERVER_PROTOCOL"]. "405 Method Not Allowed");
        exit;
    }

    //validate username
    //get username from register form
    $username = strtolower(trim(htmlspecialchars(filter_input(INPUT_POST, "username"))));
    $inputs["username"] = $username;

    //validate user name by validate_usernmae function
    if(validate_username($username) !== true){
        $errors["username"] = validate_username($username);
    }
    //check for if username already exist?
    if(Exist("user", "username", $inputs["username"])){
        $errors["username"] = "the username already exist!";
    }

    //get first name
    $FirstName = htmlspecialchars(filter_input(INPUT_POST,"FirstName"));
    $inputs["FirstName"] = $FirstName;
    //validate first name by validate_name function
    if(validate_name($FirstName) !== true){
        $errors["FirstName"] = validate_name($FirstName);
    }

    //get the last name
    $LastName = htmlspecialchars(filter_input(INPUT_POST, "LastName"));
    $inputs["LastName"] = $LastName;
    //validate it
    if(validate_name($LastName) !== true){
        $errors["LastName"] = validate_name($LastName);
    }

    //validate email
    $email = htmlspecialchars(filter_input(INPUT_POST, "email")); //get email
    $inputs["email"] = $email;
    $inputs["email"] = preg_replace('/^www./', "", $inputs["email"]); //remove "www." if user insert it

    //validate email by FILTER_VALIDATE_EMAIL
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors["email"] = "invalide email";
    }

    //check for if email exist in database or not
    if(Exist("user", "email", $inputs["email"], true)){
        $errors["email"] = "the email is already exist";
    }

    //validate password
    //first of all get the password
    $password = htmlspecialchars(filter_input(INPUT_POST, "password"));
    //hash the password
    $inputs["password"] = password_hash($password, PASSWORD_DEFAULT);
    $pattern = '/^(?=.*[a-zA-Z])(?=.*\d).{8,64}$/';
    if(!preg_match($pattern, $password)){
        $errors["password"] = "Invalide Password!!";
    }

    //if count of errors == 0
    //store user information on database

    if(count($errors) === 0){
        //generate SQL command
        $sql = "INSERT INTO user (username, firstname, lastname, email, password)
         VALUES (:username, :firstname, :lastname, :email, :password)";
        $statement = $pdo->prepare($sql);

        //binde value to sql command
        $statement->bindValue(":username", $inputs["username"]);
        $statement->bindValue(":firstname", $inputs["FirstName"]);
        $statement->bindValue("lastname", $inputs["LastName"]);
        $statement->bindValue("email", $inputs["email"]);
        $statement->bindVAlue("password", $inputs["password"]);

        //execute sql commnad
        $statement -> execute();

        //start session
        session_start();
        //regererate session
        session_regenerate_id();
        //set values in session
        $_SESSION["auth"] = true;
        $_SESSION["username"] = $inputs["username"];
        //redirect user to dash page
        header("Location:/dashboard.php", true, 301);
        exit;
    }

?>
