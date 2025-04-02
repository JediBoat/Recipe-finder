<?php

    try 
    {
        require_once("dbapi.inc.php");//links file connects to the database

        $json_data = file_get_contents("registeraccount.json");
        $registeraccounts = json_decode($json_data, JSON_OBJECT_AS_ARRAY);//retries json file data turn it into a string an place it in an array

        $query = "INSERT INTO Accounts (username, pwd, email, firstname, secondname, age) VALUES (?, ?, ? , ?, ?, ?);"; //Query for inserting data user details into accounts table

        foreach($registeraccounts as $registeraccount)//goes through the json file retrieved
        {
            $username = $registeraccount["username"];//sorts data from json file to appropriate variables
            $pwd = $registeraccount["pwd"];
            $email = $registeraccount["email"]; 
            $firstname = $registeraccount["firstname"];
            $secondname = $registeraccount["secondname"];
            $age = $registeraccount["age"];//may need to convert to integer but cant test result yet
        }


        $statement = $pdo->prepare($query);
        $statement->execute([$username, $pwd, $email, $firstname, $secondname, $age]);//submit data from user

        $pdo = null;//closing of connection to database
        $statement = null;
        
        header("signinpage.html");
        die();
        
      
    } 
    catch (PDOException $e) 
    {
        die("Failed". $e->getMessage());//it it fails it just terminates the script
    }

