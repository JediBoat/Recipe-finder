<?php

try 
    {
        require_once("dbapi.inc.php");//links file connects to the database

        $json_data = file_get_contents("../account.json");
        $userdata = json_decode($json_data, JSON_OBJECT_AS_ARRAY);

        $query = "INSERT INTO Accounts (username, pwd, email, firstname, secondname, age) VALUES (?, ?, ? , ?, ?, ?);"; //Query for inserting data user details into accounts table


        $name = $userdata["username"];
        $pwd = $userdata["password"];//stores trhem into variabiles
        $email = $userdata["email"];
        $firstname = $userdata["firstname"];
        $secondname = $userdata["secondname"];
        $age = $userdata["age"];
       

        $statement = $pdo->prepare($query);
        $statement->execute([$name, $pwd, $email, $firstname, $secondname, $age]);//submit data from user

        $pdo = null;//closing of connection to database
        $statement = null;
        

        header("Location: index.inc.php");
        exit();
    } 
    catch (PDOException $e) 
    {
        die("Failed". $e->getMessage());//it it fails it just terminates the script
    }