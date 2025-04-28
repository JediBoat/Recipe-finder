const express = require('express');
const path = require('path');
const mysql = require('mysql');
const { SolidIngredient, LiquidIngredient, CountableIngredient } = require('./main/Javascript/Ingredients');
 
const app = express();
app.use(express.json());
 
// serve static files from /main
app.use(express.static(path.join(__dirname, 'main')));
 
// serve admin page
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'main', 'adminpage.html'));
});
 
// connect to MySQL database using required credentials
const db = mysql.createConnection({
    host: 'sql8.freesqldatabase.com',
    user: 'sql8768869',
    password: 'jICFgdSB17',
    database: 'sql8768869'
});
 
// error handling for connection to database
db.connect((err) => {
    if (err) {
        console.error('Database connection error:', err);
    } else {
        console.log('Connected to MySQL database');
    }
});
 
// handle adding a recipe to MySQL
app.post('/add-recipe', (req, res) => {
    console.log("POST /add-recipe received");
    const { RecipeName, RecipeMethod, RecipeDietaries, RecipeLinks, Ingredients } = req.body;
 
    // format ingredients into a single string: "200g Flour, 100ml Milk, 2pcs Eggs" using .map function
    const formattedIngredients = Ingredients.map(ing => {
        let unit = '';
        if (ing.type === 'solid') unit = 'g';
        else if (ing.type === 'liquid') unit = 'ml';
        else if (ing.type === 'countable') unit = 'pcs';
 
        return `${ing.quantity}${unit} ${ing.name}`;
    }).join(', ');
 
    // sql query that will be used to insert into the database
    const sql = `
        INSERT INTO Recipes (recipename, instructions, ingredients, dietaries, links)
        VALUES (?, ?, ?, ?, ?)
    `;
 
    const values = [
        RecipeName,
        RecipeMethod,
        formattedIngredients,
        RecipeDietaries,
        RecipeLinks
    ];
 
    db.query(sql, values, (err, result) => {
        if (err) {
            console.error('Failed to save recipe:', err);
            return res.status(500).json({ message: 'Failed to save recipe to database' });
        }
 
        console.log('Recipe saved with ID:', result.insertId);
        res.json({ message: 'Recipe saved to database!', id: result.insertId });
    });
});
 
// handle adding a new account to MySQL
app.post('/register-account', (req, res) => {
    console.log("POST /register-account received");
    const { username, email, password, firstname, secondname, age } = req.body;
 
    const sql = `
        INSERT INTO Accounts (username, email, password, firstname, secondname, age)
        VALUES (?, ?, ?, ?, ?, ?)
    `;
 
    const values = [username, email, password, firstname, secondname, age];
 
    db.query(sql, values, (err, result) => {
        if (err) {
            console.error('Failed to register account:', err);
            return res.status(500).json({ message: 'Failed to register account' });
        }
 
        console.log('Account registered with ID:', result.insertId);
        res.json({ message: 'Account registered!', id: result.insertId });
    });
});
 
app.listen(7000, () => {
    console.log('Server running at http://localhost:7000');
});
 