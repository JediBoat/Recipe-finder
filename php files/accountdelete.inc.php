<?php

    try 
    {
        require_once("dbapi.inc.php");//links file connects to the database

        $json_data = file_get_contents("deleteaccount.json");
        $deleteaccounts = json_decode($json_data, JSON_OBJECT_AS_ARRAY);//retries json file data turn it into a string an place it in an array

        $query = "DELETE FROM username = :username AND pwd = :pwd;";//deletes user

        foreach($deleteaccounts as $deleteaccount)//goes through the json file retrieved
        {
            $username = $deleteaccount["username"];//sorts data from json file to appropriate variables
            $pwd = $deleteaccount["pwd"];
        }

        $statement = $conn->prepare($query);
        $statement->execute([$username, $pwd]);//submit data from user

        $conn = null;//closing of connection to database
        $statement = null;

        die();
        //header("");makes sure the user logins into there own page
        
    } 
    catch (PDOException $e) 
    {
        die("Failed". $e->getMessage());//it it fails it just terminates the script
    }

