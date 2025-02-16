<?php

$dsn = "mysql:host=sql8.freesqldatabase.com; dbname=;";
$dbusername = "";//Login details for the database
$dbpass = "";

try//error handling in case the database is down
{
    $conn = new PDO($dsn, $dbusername, $dbpass);// connection to object
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//if we get an error it throws an exception which is catched
}
catch(PDOException $e)
{
    echo "Connection failed". $e->getMessage() ."";// gives the user a message if the connection fails
}