<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $accountid = $_POST["accountID"];

    try
    {
        require_once("dbapi.inc.php");//links file connects to the database

        $json_data = file_get_contents("accountupdate.json");
        $updateaccounts = json_decode($json_data, JSON_OBJECT_AS_ARRAY);//retries json file data turn it into a string an place it in an array

        $query = "UPDATE Accounts SET username = :username, pwd = :pwd, email = :email, firstname = :firstname, secondname = :secondname WHERE acountID = $accountid;"; //Query for updating tabels

        foreach($updateaccounts as $updateaccount)//goes through the json file retrieved
        {
            $username = $accountupdating["username"];//sorts data from json file to appropriate variables
            $pwd = $accountupdating["pwd"];
            $email = $accountupdating["email"]; 
            $firstname = $accountupdating["firstname"];
            $secondname = $accountupdating["secondname"];
        }

        $statement = $pdo->prepare($query);

        $statement->bindParam(":username", $username);
        $statement->bindParam(":pwd", $pwd);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":firstname", $firstnamee);
        $statement->bindParam(":secondname", $secondname);
    
        
        


        $statement->execute();//submit data from user

        $pdo= null;//closing of connection to database
        $statement = null;

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
