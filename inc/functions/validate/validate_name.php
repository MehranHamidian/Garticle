<?php
    //this function used to validate name
    //this function retuen true if name is valid and return an error if name isn't valid
    function validate_name(string $name): bool|string
    {
        //set name characters to lowercase
        $name = strtolower($name);

        //define pattern 
        $pattern = '/^[a-z]{2,32}$/'; //allow 2 charcter name for east asian people
        if(preg_match($pattern, $name)){
            return true;
        }else{
            if(preg_match('/^.{2,32}$/', $name) === 0){
                return "name field should between 2-32 character!";
            }else{
                return "name should contain only letter!";
            }
        }
    }
?>