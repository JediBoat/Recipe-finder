<?php


$dsn = "mysql:host=sql8.freesqldatabase.com;dbname=sql8768869";
$dbusername = "sql8768869";//Login details for the database
$dbpass = "jICFgdSB17";

try//error handling in case the database is down
{
    $pdo = new PDO($dsn, $dbusername, $dbpass);// connection to object
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//if we get an error it throws an exception which is catched
}
catch(PDOException $e)
{
    echo "Connection failed ". $e->getMessage() ."";// gives the user a message if the connection fails
}