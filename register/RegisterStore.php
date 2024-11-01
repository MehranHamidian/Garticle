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
    //check for if user name empty. if the username field be empty, send an error message to the user.
    //In the 'register.php' page, we check if the count of errors is greater than 0; if so, we include the form page.
    //check "register.php" for this.
    if(empty($username)){
        $errors["username"] = "username is required";
    }else{
        //useranme should only contain alphabetic character and "_", we check it by preg_match() functoin.
        //We regenerate the registration form for the user if any error occurs. 
        if(preg_match('/[^a-z_]/', $username)){
            $errors['username'] = "user name should only contain alphabetic character and '_'";
        }elseif(strlen($username) < 3 ){//this for check length of username if less than 3, we have an error
            $errors["username"] = "minimum character for username is 3";
        }elseif(strlen($username) > 64){//and also morethan 64
            $errors["username"] = "maximum character for username is 64";
        }
    }

    //validate first name 
    $FirstName = trim(htmlspecialchars(filter_input(INPUT_POST,"FirstName")));
    $inputs["FirstName"] = $FirstName;
    //Now, check if it is empty??
    if(empty($FirstName)){
        $errors["FirstName"] = "First name field is required.";
    }else{
        //First name field should contain only alphabetic characters.
        if(preg_match('/[^a-zA-Z]/', $FirstName)){
            $errors["FirstName"] = "First name field should contain only alphabetic characters.";
        }elseif(strlen($FirstName) < 2){
            $errors["FirstName"] = "minimum character for first name is 2";
        }elseif(strlen($FirstName) > 64){
            $errors["FirstName"] = "maximun character for first name is 64";
        }
    }

    //validate last name
    $LastName = trim(htmlspecialchars(filter_input(INPUT_POST, "LastName")));
    $inputs["LastName"] = $LastName;
    //the LastName field is not requierd, but if user want insert it's last name check for not be less than 2 character
    if(!empty($LastName)){
        if(strlen($LastName)< 2){
            $errors["LastName"] = "minimum charcter for last name is 2";
        }elseif(preg_match('/[^a-zA-Z]/', $LastName)){
            $errors["LastName"] = "First name field should contain only alphabetic characters.";
        }elseif(strlen($LastName > 64)){
            $errors["LastName"] = "maximum character for last name is 64";
        }
    }

    //validate email
    $email = filter_input(INPUT_POST, "email"); //get email
    $inputs["email"] = $email;
    if(empty($email)){ //check if email empty
        $errors["email"] = "email field is required";
    }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //validate email by FILTER_VALIDATE_EMAIL
            $errors["email"] = "invalide email";
        }
    }

?>