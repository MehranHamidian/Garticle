<?php
    //this function is use to validate username
    //if user name valid function return true, and if username Invalid function return an error
    function validate_username(string $username): bool | string
    {   
        //first of all define a pattern for regex function
        $pattern = '/^[a-zA-Z][a-zA-Z0-9_]{2,31}$/';

        if(preg_match($pattern, $username)){
            return true;
        }else{
            //speficy errors
            if(!preg_match('/^[a-zA-Z]/', $username)){
                $error = "username should start by letter!"; 
            }elseif(preg_match('/[^a-zA-Z0-9_]/', $username)){
                $error = "username should contain a-z, A-Z, 0-9 and _";
            }else{
                $error = "username should between 3-32 characters";
            }
            
            //return error
            return $error;
        }
    }
?>