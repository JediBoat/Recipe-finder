<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = $_POST["username"];//replace with form variable
    $pwd= $_POST["pwd"];//replace with form variable
    $accountid = $_POST["accountID"];

    try 
    {
        require_once("dbapi.inc.php");//links file connects to the database

        $query = "DELETE FROM username = $username AND pwd = $pwd AND acountID = $accountid;";//deletes user

        $statement = $pdo->prepare($query);

        $statement->execute();//submit data from user

        $pdo = null;//closing of connection to database
        $statement = null;

        header("mainpagesearch.inc.php");
        die();
      
        
    } 
    catch (PDOException $e) 
    {
        die("Failed". $e->getMessage());//it it fails it just terminates the script
    }
    
   

}
else
{
    header("mainpagesearch.inc.php");

}

