<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $recpie = $_POST["recipe"];//replace with form variable
    $recpieID = $_POST["recipieID"];//replace with form variable
    $admin = false;

    try 
    {
        
        require_once("dbapi.inc.php");//links file connects to the database

        $query = "SELECT * FROM Recipes WHERE recipename = '$recpie' AND recipeID = '$recpieID';";// selects all the data that matches 

        $statement = $pdo->prepare($query);

        

        $statement->execute();//submit data from user

        

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);//gets the reults

        if (file_exists("currentaccount.json"))
        {
            $json_data = file_get_contents("currentaccount.json");
            $useraccount = json_decode($json_data, JSON_OBJECT_AS_ARRAY);
            $email = $useraccount["Email"];
            $id = $useraccount["AccountID"];
    
            $adminquery = "SELECT * FROM Admins WHERE email = '$email' AND acountID = '$id';";// selects all the data that matches 
            $adstatement = $pdo->prepare($adminquery);
            $adstatement->execute();//submit data from user
            $adresults = $adstatement->fetchAll(PDO::FETCH_ASSOC);//gets the reults

            if(empty($adresults))// for getting the right information out
            {
                $admin = false;
            }
            else
            {
                $admin = True;
            }
        }
        

        $pdo = null;//closing of connection to database
        $statement = null;
      
    } 
    catch (PDOException $e) 
    {
        die(" Failed ". $e->getMessage());//it it fails it just terminates the script
        
    }
}
else if(file_exists("currentaccount.json"))
{

    try
    {
        require_once("dbapi.inc.php");//links file connects to the database
        $json_data = file_get_contents("currentaccount.json");

        $useraccount = json_decode($json_data, JSON_OBJECT_AS_ARRAY);

        $email = $useraccount["Email"];
        $id = $useraccount["AccountID"];

        $adminquery = "SELECT * FROM Admins WHERE email = '$email' AND acountID = '$id';";// selects all the data that matches 

        $adstatement = $pdo->prepare($adminquery);

        $adstatement->execute();//submit data from user

        $adresults = $adstatement->fetchAll(PDO::FETCH_ASSOC);//gets the reults

        if(empty($adresults))// for getting the right information out
        {
            $admin = false;
        }
        else
        {
            $admin = True;
        }
    } 
    catch (PDOException $e) 
    {
        die(" Failed ". $e->getMessage());//it it fails it just terminates the script
        
    }

    $pdo = null;//closing of connection to database
    $statement = null;
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

if (file_exists("currentaccount.json")) //checks if there is an  account json file 
{
    $json_data = file_get_contents("currentaccount.json");
    $useraccount = json_decode($json_data, JSON_OBJECT_AS_ARRAY);

    $linkaddress = "../PHP/accountpage.inc.php";
    $linkname = $useraccount["Username"]; 
}
else
{
    $linkaddress = "../main/signinpage.html";
    $linkname = "Sign Up/Login";
    $admin = false;
}

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
                <?php echo "<li> <a href= $linkaddress > $linkname </a> </li>"?>
                <?php if ($admin) {echo "<li><a href='http://localhost:7000/adminpage.html'> admin </a></li>";}?>
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

    <section class="reciperesults">
    <section class="name-container">  
            <div class="name-container"> 
                <h1 class="nameof-item"> <?php echo $name_string; ?></h1>
            </div>    
    </section>

    <section class="dietaries_container">  
            <div class="dietaries-container">
                   <p class="dietaries-item">This recipe is suitable for the following dietary groups: <?php foreach ($DietariesArray as $Dietaries) { echo $Dietaries; } ?></p>
            </div>
    </section>

    <section class="photo-ingredient-container">
    <section class="photo-container">  
            <div class="photo-container"> 
                <?php echo "<img class='recipe-img' src='../Recipie images/$photoofrecipie'>" ?>
            </div>    
    </section>

    <section class="ingrd_container">  
            <div class="ingrd-container"> 
                <h2 class="ingrd-header">Required Ingredients:</h2>
                   <p class="ingrd-item"> <?php foreach ($IngredientArray as $Ingredient) { echo $Ingredient . "<br><br>"; } ?></p>
            </div>
    </section>
    </section>

    <section class="instructions-container">  
            <div class="instructions-container"> 
                <h2 class="instructions-header">Instructions:</h2>
                <p class="instructions-item"> <?php foreach ($InstructionArray as $Instruction) { echo $Instruction . "<br><br>"; } ?></p>
            </div>    
    </section>

    </section>


    

    <section class="footer">
        <!-- <div class="random-recipe"></div> POTENTIAL ADDITION UNCLEAR FOR IMPLEMENTATION -->
    </section>  

    
</body>
</html>