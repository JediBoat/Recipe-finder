<?php

// if ($_SERVER["REQUEST_METHOD"] == "POST")
// {
//      $recpie = $_POST["recipe"];//replace with form variable
    

    try 
    {
        $recpie = "Gluten-free Pizza";
        require_once("dbapi.inc.php");//links file connects to the database

        $query = "SELECT recipeID, recipename, dietaries FROM Recipes WHERE recipename LIKE '%$recpie%' ;";// selects all the data that matches 

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


if(empty($results))
{
    echo"No";
}
else
{
    $recpieresults = [];
    $i = 0;

    foreach ($results as $result) 
    {
        
        $recpieresults[$i] = ($result["recipeID"]);
        $i = $i+1;
        $recpieresults[$i] = ($result["recipename"]);
        $i = $i+1;
        $recpieresults[$i] = ($result["dietaries"]);
        $i = $i+1;

       
    }



}
; 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Dishcovery - Home</title>
</head>
<body>
    <header> <!-- Header and container of top half of
         the website -->

        <div class="logo">Dishcovery</div>

        <nav class="menu-bar"> <!-- Menu bar for responsive and standard layout more may need to be added -->
            <ul>
                <li><a href="index.html"> Home </a></li>
                <li><a href="html/loginpage.html"> Sign Up/Login </a></li>
                <li><a href="adminpage.html"> admin </a></li>

            </ul>
        </nav>

        <div class="searchbar-container"> <!-- Search bar container and classes unsure what else may be needed for the future functionality but ive added what I think is necessary-->
            <div class="search-bar">
                <form class="search-form" method="post" action="php files\search.inc.php">
                    <p class="search-title">Search Recipes:</p>
                    <input type="text" id="recipe" name="recipe" class="search-input-field" placeholder="Search Recipes.." required>
                    <button type="submit" class="search-btn"></button>
                </form>
            </div>
    </header>

    <section class="container"> <!-- Container of bottom half of website -->

        <section class="ingrd_and_fltr-container">  <!-- Ingredient and filters container and classes --> 
            <div class="ingrd-container"> <!-- Ingredients cointainer and classes -->
                <ul class="ingrd-list-container">
                   <li class="ingrd-item">
                        <button class="add-ingrd-btn"></button> <!-- Add and remove buttons -->
                        <button class="sub-ingrd-btn"></button>
                    </li>
                </ul>
            </div>

            <div class="fltr-container"> <!-- Filters container and classes -->
                <ul class="fltr-list-container">
                    <li class="fltr-item">
                        <button class="add-fltr-btn"></button>
                        <button class="sub-fltr-btn"></button>
                    </li>
                </ul>
            </div>    
        </section>

        <section class="recipes-container"> <!-- Recipes container and classes -->
            <ul class="recipe-list-container">
                <li class="recipe-section">
                    <p> <?php  $j = 0; 
                        for ($x = count($recpieresults); $x > 0; $x-=3) 
                            {
                                echo "<p class = 'whatever'>" .$recpieresults[$j] . "</p>"; 
                                echo "<p class = 'whatever'>" .$recpieresults[$j + 1] . "</p>"; 
                                echo "<p class = 'whatever'>" .$recpieresults[$j + 2] . "</p>"; 
                                $j = $j + 3;
                            }
                        ?>
                    </p>

   
                </li>
            </ul>
        </section>

        <!-- <div class="current-filters">
            <ul class="curr-filters">
                <li class="curr-filters-section">
                    <button class="remove-filter-btn"></button>
                </li>
            </ul> 
        </div> UNSURE IF THIS IS NEEDED YET -->

    </section>
        
    <section class="footer">
    <!-- <div class="random-recipe"></div> POTENTIAL ADDITION UNCLEAR FOR IMPLEMENTATION -->
    </section>  

</body>
</html>

