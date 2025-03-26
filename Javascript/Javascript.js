import fs from 'fs'
const fs = require('fs'); // enables read and writing
const path = require('path')

var recipeId = 1; //increment ID every time new recipe is added //find a way to store this 

document.getElementById("addRecipeButton").addEventListener("click", function () {
	alert("recipe added")

	var recipe = { // Javascript object of the full recipe 
		RecipeId : recipeId, 
		RecipeName : document.getElementById('recipeNameInputBox').innerHTML, 
		RecipeIngredients : document.getElementById('recipeIngredientsBox').innerHTML, 
		RecipeMethod : document.getElementById('recipeMethodBox').innerHTML 
	};

	var jsonRecipeData = JSON.stringify(recipe); //makes the Javascript object into json 
	console.log(jsonRecipeData); 

	// write a new json file in the same workspace when fields filled in 
	fs.writeFile('recipe' + recipeId + '.json', jsonRecipeData), (error) => {  
	
    console.log('recipe has been written correctly'); 

}
});

//establishing database connection to mySQL database 
// C:\Users\Your Name>node demo_db_connection.js using terminal to establish database connection 

var mysql = require('mysql'); // insert mysql link 

var con = mysql.createConnection({  

	host : 'sql8.freesqldatabase.com', 
	user: 'sql8768869', 
	password : 'jICFgdSB17' 

}); 

Con.connect(function(err) { 

	If (err) ; throw err; 

	Console.log('Connected!'); 

}); 

//Querying the database, it takes a SQL statement as a parameter and returns the result 

con.connect(function(err) { 

	If (err) ; throw err; 
	console.log('Connected');

con.query(sql, function (err, result) { 

	If (err) ; throw err; 
	Console.log('Result: ' + result); 

});	 

}); 