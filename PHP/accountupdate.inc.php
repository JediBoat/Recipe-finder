<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = $_POST["email"];//replace with form variable
    $pwd = $_POST["password"];


    try
    {
        require_once("dbapi.inc.php");//links file connects to the database

        $json_data = file_get_contents("currentaccount.json");
        $useraccount = json_decode($json_data, JSON_OBJECT_AS_ARRAY);

        $id = $useraccount["AccountID"];

        $query = "UPDATE Accounts SET email = :email WHERE acountID = $id AND pwd = '$pwd';"; //Query for updating tabels

        $statement = $pdo->prepare($query);

        $statement->bindParam(":email", $email);


        $statement->execute();//submit data from user

        $pdo= null;//closing of connection to database
        $statement = null;

        header("Location: filedelete.inc.php");
        die();
    } 
    catch (PDOException $e) 
    {
        die("Failed". $e->getMessage());//it it fails it just terminates the script
    }
}
else
{
    header("Location: index.inc.php");
}
