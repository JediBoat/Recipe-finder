<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $new_username = $_POST["username"];//replace with form variable
    $new_pwd = $_POST["new-password"];


    try
    {
        require_once("dbapi.inc.php");//links file connects to the database

        $json_data = file_get_contents("currentaccount.json");
        $useraccount = json_decode($json_data, JSON_OBJECT_AS_ARRAY);

        $id = $useraccount["AccountID"];
        $accountemail = $useraccount["Email"];

        $query = "UPDATE Accounts SET username = :username, pwd = :pwd WHERE acountID = '$id' AND email = '$accountemail';"; //Query for updating tabels

        $statement = $pdo->prepare($query);

        $statement->bindParam(":email", $new_username);
        $statement->bindParam(":pwd", $new_pwd);


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
