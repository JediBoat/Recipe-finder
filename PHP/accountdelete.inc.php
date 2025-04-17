<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = $_POST["email"];//replace with form variable
    $pwd= $_POST["pwd"];//replace with form variable

    try 
    {
        $json_data = file_get_contents("../account.json");
        $accountdata = json_decode($json_data, JSON_OBJECT_AS_ARRAY);

        $accountid = $accountdata["AccountID"];

        require_once("dbapi.inc.php");//links file connects to the database

        $query = "DELETE FROM email = $email AND pwd = $pwd AND acountID = $accountid;";//deletes user

        $statement = $pdo->prepare($query);

        $statement->execute();//submit data from user

        $pdo = null;//closing of connection to database
        $statement = null;

        header("index.inc.php");
        die();
      
        
    } 
    catch (PDOException $e) 
    {
        die("Failed". $e->getMessage());//it it fails it just terminates the script
    }
    
   

}
else
{
    header("index.inc.php");

}

