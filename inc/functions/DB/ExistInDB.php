<?php
    //this function check for if exist a specify parameter on database or not 
    //if parameter exist in the database function retern true and otherwise function retuen false
    
    define("ROOT_DIR", $_SERVER["DOCUMENT_ROOT"]); // define root directory
    $path = ROOT_DIR. "/connection.php"; //define a path for 'connection.php file' for prevent doublicate import this file
    
    if(!file_exists($path)){
        $pdo = require_once __DIR__. "/../../../connection.php"; //require 'connectino.php' for connect to database
    }
    
    
    function Exist(string $table, string $column, string $parameter, bool $case_sensetive = false) :bool
    {
        global $pdo;
        //generate SQL command
        if($case_sensetive === true){ 
            $sql_command = "SELECT COUNT($column) AS result FROM $table WHERE BINARY $column = :parameter";
        }else{
            $sql_command = "SELECT COUNT($column) AS result FROM $table WHERE $column = :parameter";
        }

        $statement = $pdo->prepare($sql_command);

        // Bind the parameter for the value
        $statement->bindParam(":parameter", $parameter);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if($result["result"] == 0){ //if count be 0 return false
            return false; 
        }else{ //and otherwise return true
            return true;
        }
    }

?>