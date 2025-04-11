document.getElementById("addRecipeButton").addEventListener("click", function () {

	var recipe = { // Javascript object of the full recipe 
		RecipeName : document.getElementById('recipeNameInputBox').value,
		RecipeMethod : document.getElementById('recipeMethodBox').value,
		RecipeIngredients : document.getElementById('recipeIngredientsBox').value, 
		RecipeDietaries : document.getElementById('recipeDietariesBox').value,
		RecipeLinks : document.getElementById('recipeLinksBox').value
	};

	fetch('/add-recipe', { // fetch request to 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(recipe)
    })
    .then(response => response.json())
    .then(data => {
        alert("Recipe added successfully!");
        console.log(data);
        window.location.replace('http://localhost:3000/PHP/addrecpie.inc.php');
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

//establishing database connection to mySQL database 
// C:\Users\Your Name>node demo_db_connection.js using terminal to establish database connection 

// var mysql = require('mysql'); // insert mysql link 

// var con = mysql.createConnection({  

// 	host : 'sql8.freesqldatabase.com', 
// 	user: 'sql8768869', 
// 	password : 'jICFgdSB17' 

// }); 

// Con.connect(function(err) { 

// 	If (err) ; throw err; 

// 	Console.log('Connected!'); 

// }); 

// //Querying the database, it takes a SQL statement as a parameter and returns the result 

// con.connect(function(err) { 

// 	If (err) ; throw err; 
// 	console.log('Connected');

// con.query(sql, function (err, result) { 

// 	If (err) ; throw err; 
// 	Console.log('Result: ' + result); 

// });	 

// }); 