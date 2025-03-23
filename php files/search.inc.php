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
        //echo ($result["recipename"]);//retrieves results 
        $instruction_string = ($result["instructions"]);//need wait for html then adjust it
        //echo ($result["dietaries"]);
        //echo ($result["ingredients"]);
        //echo ($result["links"]);
       
    }
//code for sorting out informatiuon to put in strings
    $posistion1 = strpos($instruction_string, "Step 2:");//gets the position of the first instrunctions
    $myresult1 = substr($instruction_string, 0, $posistion1);//cuts the string up to only extract the firs instrunction
    echo $myresult1;
    
    
    $posistion2 = strpos($instruction_string, "Step 3:");//get the posistion of step 2
    $myresult2 = substr($instruction_string, $posistion1, ($posistion2 - $posistion1));
    echo $myresult2;

    $posistion3 = strpos($instruction_string, "Step 4:");//get the posistion of step 3
    $myresult3 = substr($instruction_string, $posistion2, ($posistion3 - $posistion2));
    echo $myresult3;

    $posistion4 = strpos($instruction_string, "END.");//get the posistion of step 4
    $myresult4 = substr($instruction_string, $posistion3, ($posistion4 - $posistion3));
    echo $myresult4;
}
