// variables to hold the content that will be parsed into the json file

var recipeId = 1; //increment ID every time new recipe is added //find a way to store this 
var  recipeName = document.getElementById('recipeNameInputBox'); 
var  recipeIngredients = document.getElementByClassName('recipeIngredentsBox'); //array 
var recipeMethod = document.getElementById('recipeMethodBox'); 

var recipe = { // Javascript object of the full recipe 
RecipeId : recipeId, 
RecipeName : recipeName, 
RecipeIngredients : recipeIngredients, 
RecipeMethod : recipeMethod 
}; 

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

var jsonRecipeData = JSON.stringify(recipe); //makes the Javascript object into json 

const fs = require('fs'); // enables read and writing 

if (isEmpty() == True) {

    Document.getElementByID('errorBox').innerHTML = 'Please fill in required fields';	 

} else { 
	// write a new json file in the same workspace when fields filled in 
fs.writeFile('recipe' + recipeId + '.json', jsonRecipeData), (error) => {  

	if (error) { //error handling 
		console.error(error); 
		throw error; 

    } 

    recipeId += 1; 
    console.log('recipe has been written correctly'); 

} 

}


function isEmpty(name, ingredients, method) { //error checking to check for required fields 
	Return (name.length === 0 || ingredients.length === 0 || method.length === 0);  
} 

 

//Querying the database, it takes a SQL statement as a parameter and returns the result 

con.connect(function(err) { 

	If (err) ; throw err; 
	console.log('Connected');

con.query(sql, function (err, result) { 

	If (err) ; throw err; 
	Console.log('Result: ' + result); 

});	 

}); 