<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
     $recpie = $_POST["recipe"];//replace with form variable

    

    try 
    {

        require_once("dbapi.inc.php");//links file connects to the database

        $query = "SELECT recipeID, recipename, dietaries, links FROM Recipes WHERE recipename LIKE '%$recpie%' ;";// selects all the data that matches 

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



if(empty($results))// for getting the right information out
{
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
        $recpieresults[$i] = ($result["links"]);
        $i = $i+1;

       
    }



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
    <title>Dishcovery - Home</title>
</head>
<body>
    <header> <!-- Header and container of top half of
         the website -->

        <div class="logo">Dishcovery</div>

        <nav class="menu-bar"> <!-- Menu bar for responsive and standard layout more may need to be added -->
            <ul>
                <li><a href="index.inc.php"> Home </a></li>
                <?php echo "<li> <a href= $linkaddress > $linkname </a> </li>"?>
                <li><a href="http://localhost:7000/adminpage.html"> admin </a></li>

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

    <section class="container"> <!-- Container of bottom half of website -->

        <section class="ingrd_and_fltr-container">  <!-- Ingredient and filters container and classes --> 
            <div class="ingrd-container"> <!-- Ingredients cointainer and classes -->
                <ul class="ingrd-list-container">
                   <li class="ingrd-item">
                    <button class="add-ingrd-btn"><i class="fa fa-plus"></i> Ingredients</button> <!-- Add and remove buttons -->
                    <button class="sub-ingrd-btn"><i class="fa fa-minus"></i> Ingredients</button>
                    </li>
                </ul>
            </div>

            <div class="fltr-container"> <!-- Filters container and classes -->
                <ul class="fltr-list-container">
                    <li class="fltr-item">
                        <button class="add-fltr-btn"><i class="fa fa-plus"></i> Filters</button>
                        <button class="sub-fltr-btn"><i class="fa fa-minus"></i> Filters</button>
                    </li>
                </ul>
            </div>    
        </section>

        <section> <!-- Recipes container and classes -->
            <section class='recipes-container'>
                     <?php  $j = 0; 
                        if(empty($recpieresults))
                        {
                            echo "<p class = 'whatever'> No Recipies found </p>";
                        }
                        else
                        {
                            for ($x = count($recpieresults); $x > 0; $x-=4) 
                                {
                                    $value1 = $recpieresults[$j];
                                    $value2 = $recpieresults[$j + 1];
                                    $value3 = $recpieresults[$j + 2];
                                    $value4 = $recpieresults[$j + 3];

                                    echo " 
                                         <ul class='recipe-list-container'>
                                            <li class='recipe-section'>
                                                <img class='recipe-img' src='../Recipie images/$value4'>
                                                    <p class = 'whatever'> $value2 </p>
                                                    <p class = 'whatever'> $value3 </p>
                                                    <form action='search.inc.php' method='post'>  
                                                        <input hidden type='number' name= 'recipieID' value='$value1'> 
                                                        <input hidden type='text' name='recipe' value='$value2'> 
                                                        <input type='submit' value='View recipe'>
                                                    </form>
                                                </li>
                                            </ul>";
                                    $j = $j + 4;
                                    
                                }
                        }
                        ?>
                    
            </section>
        </section>

    </section> 

    <section class="footer">

    </section>  

</body>
</html>

