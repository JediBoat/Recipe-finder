<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $recpie = $_POST["recipesearch"];//replace with form variable
    

    try 
    {
        require_once("dbapi.inc.php");//links file connects to the database

        $query = "SELECT * FROM Recipes WHERE recipename = :recipesearch";// selects all the data that matches 

        $statement = $conn->prepare($query);
        $statement->execute([$recpie]);//submit data from user

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);//gets the reults

        $conn = null;//closing of connection to database
        $statement = null;

        
        
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

#########################################################################################################################
if(empty($results))
{
    echo"";
}
else
{
    foreach ($results as $result) 
    {
        echo htmlspecialchars($result["recipename"]);//retrieves results 
        echo htmlspecialchars($result["instructions"]);//need wait for html then adjust it
        echo htmlspecialchars($result["dietaries"]);
        echo htmlspecialchars($result["ingredients"]);
        echo htmlspecialchars($result["links"]);
    }
}
