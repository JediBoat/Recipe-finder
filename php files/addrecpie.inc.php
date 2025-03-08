<?php

try 
    {
        require_once("dbapi.inc.php");//links file connects to the database

        $json_data = file_get_contents("userrecipe.json");
        $userrecipes = json_decode($json_data, JSON_OBJECT_AS_ARRAY);

        $query = "INSERT INTO Recipes (recipename, instructions, ingredients, dietaries, links) VALUES (?, ?, ? , ?, ?);"; //Query for inserting data user details into accounts table

        foreach($userrecipes as $userrecipe)//goes through the json file retrieved
        {
            $recipename = $userrecipe["recipename"];
            $instructions = $userrecipe["instructions"];//stores trhem into variabiles
            $ingredients= $userrecipe["ingredients"];
            $dietaries = $userrecipe["dietaries"];
            $links = $userrecipe["links"];
        }

        $statement = $conn->prepare($query);
        $statement->execute([$recipename, $instructions, $ingredients, $dietaries, $links]);//submit data from user

        $conn = null;//closing of connection to database
        $statement = null;

        die();
    } 
    catch (PDOException $e) 
    {
        die("Failed". $e->getMessage());//it it fails it just terminates the script
    }