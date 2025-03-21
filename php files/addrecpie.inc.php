<?php

try 
    {
        require_once("dbapi.inc.php");//links file connects to the database

        $json_data = file_get_contents("userrecipe.json");
        $userrecipes = json_decode($json_data, JSON_OBJECT_AS_ARRAY);

        $query = "INSERT INTO Recipes (recipename, instructions, ingredients, dietaries, links) VALUES (?, ?, ? , ?, ?);"; //Query for inserting data user details into accounts table

        foreach($userrecipes as $userrecipe)//goes through the json file retrieved
        {
            $recipename = $userrecipe["recipeName"];
            $instructions = $userrecipe["recipeMethod"];//stores trhem into variabiles
            $ingredients= $userrecipe["recipeIngredients”"];
            $dietaries = $userrecipe["recipeDietaries"];
            $links = $userrecipe["recipeLinks"];
        }

        $statement = $pdo->prepare($query);
        $statement->execute([$recipename, $instructions, $ingredients, $dietaries, $links]);//submit data from user

        $conn = null;//closing of connection to database
        $statement = null;

        die();
    } 
    catch (PDOException $e) 
    {
        die("Failed". $e->getMessage());//it it fails it just terminates the script
    }