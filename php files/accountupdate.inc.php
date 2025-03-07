<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = $_POST["username"];//replace with form variable
    $pwd = $_POST["password"];//replace with form variable
    $email = $_POST["email"];//replace with form variable 
    $firstname = $_POST["username"];//replace with form variable
    $secondname = $_POST["password"];//replace with form variable
    $age = $_POST["email"];//replace with form variable 

    try 
    {
        require_once("dbapi.inc.php");//links file connects to the database

        //need to write code to get the user account id

        $query = "UPDATE Accounts SET username = :username, pwd = :pwd, email = :email, firstname = :firstname, secondname = :secondname WHERE acountID = ;"; //Query for updating tabels

        $statement = $conn->prepare($query);
        $statement->execute([$username, $pwd, $email, $firstname, $secondname]);//submit data from user

        $conn = null;//closing of connection to database
        $statement = null;

        die();
        //header("");makes sure the user logins into there own page
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