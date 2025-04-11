<?php

try 
    {
        require_once("dbapi.inc.php");//links file connects to the database

        $json_data = file_get_contents("../recipe.json");
        $userrecipes = json_decode($json_data, JSON_OBJECT_AS_ARRAY);

        $query = "INSERT INTO Recipes (recipename, instructions, ingredients, dietaries, links) VALUES (?, ?, ? , ?, ?);"; //Query for inserting data user details into accounts table


        $recipename = $userrecipes["RecipeName"];
        $instructions = $userrecipes["RecipeMethod"];//stores trhem into variabiles
        $ingredients= $userrecipes["RecipeIngredients"];
        $dietaries = $userrecipes["RecipeDietaries"];
        $links = $userrecipes["RecipeLinks"];
       

        $statement = $pdo->prepare($query);
        $statement->execute([$recipename, $instructions, $ingredients, $dietaries, $links]);//submit data from user

        $pdo = null;//closing of connection to database
        $statement = null;
        

        header("Location: http://localhost:7000/adminpage.html");
        exit();
    } 
    catch (PDOException $e) 
    {
        die("Failed". $e->getMessage());//it it fails it just terminates the script
    }