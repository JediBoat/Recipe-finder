<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $recpie = $_POST["recipe"];//replace with form variable
    $recpieID = $_POST["recipieID"];//replace with form variable
    

    try 
    {
        
        require_once("dbapi.inc.php");//links file connects to the database

        $query = "SELECT * FROM Recipes WHERE recipename = '$recpie' AND recipeID = '$recpieID';";// selects all the data that matches 

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
}
else 
{
    //header("");makes sure the user enter the right detals properly or sends them back to the login page
}


if(empty($results))
{

}
else
{
    foreach ($results as $result) 
    {
        $name_string = ($result["recipename"]);//retrieves results 
        $instruction_string = ($result["instructions"]);//need wait for html then adjust it
        $ingredients_string = ($result["ingredients"]);
        $dietaries_string = ($result["dietaries"]);
        $photoofrecipie = ($result["links"]);
       
    }
    
    
    $InstructionArray = explode('Step', $instruction_string); 
    $IngredientArray = explode(',', $ingredients_string ); 
    $DietariesArray = explode(',', $dietaries_string ); 

}

// if (file_exists("../account.json")) //checks if there is an  account json file 
// {
//     $json_data = file_get_contents("../account.json");
//     $useraccount = json_decode($json_data, JSON_OBJECT_AS_ARRAY);
// }
// else
// {
//     $useraccount = "blank";
// }

// if(empty($useraccount))
// {   

//     $linkaddress = "../main/signinpage.html";
//     $linkname = "Sign Up/Login";

// }
// else
// {   
//     $linkaddress = "../PHP/accountpage.inc.php";
//     $linkname = $useraccount["Username"]; 
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../main/styles.css">
    <title>Dishcovery - <?php echo $name_string; ?></title> 
    <!-- Jed or Ammar needs to write code so the right recipe name shows up here -->
</head>

<body>

    <header> <!-- Header and container of top half of the website -->

        <div class="logo">Dishcovery</div>

        <nav class="menu-bar"> <!-- Menu bar for responsive and standard layout more may need to be added -->
            <ul>
                <li><a href="index.inc.php"> Home </a></li>
                <li><a href="../main/signinpage.html"> Sign Up/Login </a></li>
            </ul>
        </nav>

        <div class="searchbar-container"> <!-- Search bar container and classes unsure what else may be needed for the future functionality but ive added what I think is necessary-->
            <div class="search-bar">
                <form class="search-form" method="post" action="index.inc.php">
                    <p class="search-title">Search Recipes:</p>
                    <input type="text" id="recipe" name="recipe" class="search-input-field" placeholder="Search Recipes.." required>
                    <button type="submit" class="search-btn"><i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
    </header>

    <section class="name-container">  
            <div class="name-container"> 
                <p class="nameof - item"> <?php echo $name_string; ?></p>
            </div>    
    </section>

    <section class="photo-container">  
            <div class="photo-container"> 
                <?php echo "<img class='recipe-img' src='../Recipie images/$photoofrecipie'>" ?>
            </div>    
    </section>

    <section class="instructions-container">  
            <div class="instructions-container"> 
                <p class="instructions-item"> <?php foreach ($InstructionArray as $Instruction) { echo $Instruction . "<br>"; } ?></p>
            </div>    
    </section>

    <section class="ingrd_container">  
            <div class="ingrd-container"> 
                   <p class="ingrd-item"> <?php foreach ($IngredientArray as $Ingredient) { echo $Ingredient . "<br>"; } ?></p>
            </div>
    </section>

    <section class="dietaries_container">  
            <div class="dietaries-container"> 
                   <p class="dietaries-item"> <?php foreach ($DietariesArray as $Dietaries) { echo $Dietaries; } ?></p>
            </div>
    </section>


    

    <section class="footer">
        <!-- <div class="random-recipe"></div> POTENTIAL ADDITION UNCLEAR FOR IMPLEMENTATION -->
    </section>  

    
</body>
</html>