const express = require('express');
const fs = require('fs');
const path = require('path');

const app = express();
app.use(express.json());

// Serve everything from /public folder
app.use(express.static(path.join(__dirname, 'main')));

// Serve index/admin page
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'main', 'adminpage.html'));
});

let recipeId = 1;

app.post('/add-recipe', (req, res) => {
    console.log("POST /add-recipe received");
    console.log("Request body:", req.body);

    const recipe = {
        RecipeId: recipeId++,
        ...req.body
    };

    const filePath = path.join(__dirname, `recipe${recipe.RecipeId}.json`);
    fs.writeFile(filePath, JSON.stringify(recipe, null, 2), (err) => {
        if (err) {
            console.error('Error writing file:', err);
            return res.status(500).json({ message: 'Failed to save recipe' });
        }
        console.log('Recipe written to:', filePath);
        res.json({ message: 'Recipe saved', id: recipe.RecipeId });
    });
});

app.listen(3000, () => {
    console.log('Server running at http://localhost:3000');
});
