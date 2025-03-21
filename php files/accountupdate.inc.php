<?php
try
{
    require_once("dbapi.inc.php");//links file connects to the database

    $json_data = file_get_contents("accountupdate.json");
    $updateaccounts = json_decode($json_data, JSON_OBJECT_AS_ARRAY);//retries json file data turn it into a string an place it in an array

    $query = "UPDATE Accounts SET username = :username, pwd = :pwd, email = :email, firstname = :firstname, secondname = :secondname WHERE acountID = ;"; //Query for updating tabels

    foreach($updateaccounts as $updateaccount)//goes through the json file retrieved
    {
        $username = $accountupdating["username"];//sorts data from json file to appropriate variables
        $pwd = $accountupdating["pwd"];
        $email = $accountupdating["email"]; 
        $firstname = $accountupdating["firstname"];
        $secondname = $accountupdating["secondname"];
    }

    $statement = $pdo->prepare($query);
    $statement->execute([$username, $pwd, $email, $firstname, $secondname]);//submit data from user

    $conn = null;//closing of connection to database
    $statement = null;

    die();
} 
catch (PDOException $e) 
{
    die("Failed". $e->getMessage());//it it fails it just terminates the script
}
