<?php

// if ($_SERVER["REQUEST_METHOD"] == "POST")
// {
     //$recpie = $_POST["recipesearch"];//replace with form variable
    

    try 
    {
        $recpie = "Gluten-free Pizza";
        require_once("dbapi.inc.php");//links file connects to the database

        $query = "SELECT * FROM Recipes WHERE recipename = '$recpie';";// selects all the data that matches 

        $statement = $pdo->prepare($query);

        

        $statement->execute();//submit data from user

        

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);//gets the reults
        

        $pdo = null;//closing of connection to database
        $statement = null;

        
        
    } 
    catch (PDOException $e) 
    {
        echo $recpie;
        die(" Failed ". $e->getMessage());//it it fails it just terminates the script
        
    }
// }
// else 
// {
//     //header("");makes sure the user enter the right detals properly or sends them back to the login page
// }

#########################################################################################################################
if(empty($results))
{
    echo"No";
}
else
{
    foreach ($results as $result) 
    {
        echo ($result["recipename"]);//retrieves results 
        echo ($result["instructions"]);//need wait for html then adjust it
        echo ($result["dietaries"]);
        echo ($result["ingredients"]);
       echo ($result["links"]);
       
    }
}
