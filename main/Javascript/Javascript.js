let ingredientArray = []; // to store multiple ingredients
 
function addIngredient() {
    const name = document.getElementById('ingredientName').value;
    const quantity = document.getElementById('ingredientQuantity').value;
    const type = document.getElementById('ingredientType').value;
 
    ingredientArray.push({ name, quantity, type });
 
    const li = document.createElement('li');
    li.textContent = `${quantity} ${type} of ${name}`;
    document.getElementById('ingredientList').appendChild(li);
}
 
// create a json object of required fields
// sends post request to server add recipe where it will send to the database
document.getElementById("addRecipeButton").addEventListener("click", function () {
    const recipe = {
        RecipeName: document.getElementById('recipeNameInputBox').value,
        RecipeMethod: document.getElementById('recipeMethodBox').value,
        Ingredients: ingredientArray,
        RecipeDietaries: document.getElementById('recipeDietariesBox').value,
        RecipeLinks: document.getElementById('recipeLinksBox').value
    };
 
    fetch('/add-recipe', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(recipe)
    })
    .then(response => response.json())
    .then(data => {
        alert("Recipe saved!");
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
 
//handle accounts

document.getElementById('accountButton').addEventListener('click', function() {
 
    const account = {
        username: document.getElementById('username').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
        firstname: document.getElementById('firstname').value,
        secondname: document.getElementById('secondname').value,
        age: document.getElementById('age').value
    };
 
    fetch('/register-account', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(account)
    })
    .then(response => response.json())
    .then(data => {
        alert("Account registered successfully!");
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

const mysql = require('mysql');//security flaw I dont think it needs this code plus not on sever can be seen
 
const db = mysql.createConnection({
    host: 'sql8.freesqldatabase.com',
    user: 'sql8768869',
    password: 'jICFgdSB17',
    database: 'DishcoveryDatabase'
});
 
// error handling for database connection
db.connect((err) => {
    if (err) {
        console.error('Database connection failed:', err);
        return;
    }
    console.log('Connected to MySQL database!');
});