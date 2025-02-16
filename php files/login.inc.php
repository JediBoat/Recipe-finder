<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = $_POST["username"];//replace with form variable
    $pwd = $_POST["password"];//replace with form variable
    $email = $_POST["email"];//replace with form variable 

    try 
    {
        require_once("dbapi.inc.php");//links file connects to the database

        $query = "INSERT INTO Accounts (username, pwd, email) VALUES (?, ?, ?);"; //Query for inserting data user details into accounts table

        $statement = $conn->prepare($query);
        $statement->execute([$username, $pwd, $email]);//submit data from user

        $conn = null;//closing of connection to database
        $statement = null;

        die();
        //header("");makes sure the user logins into there own page
        // You need to wait for html before adding more 
    } 
    catch (PDOException $e) 
    {
        die("Failed". $e->getMessage());//it it fails it just terminates the script
    }
}
else 
{
    //header("");makes sure the user enter the right detals properly or sends them back to the login page
}