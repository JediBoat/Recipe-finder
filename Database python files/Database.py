import mysql.connector

connection = mysql.connector.connect(host='sql8.freesqldatabase.com',
                                     user='sql8768869',
                                    password='jICFgdSB17',
                                    database="sql8768869"
                                    )#Connect to the database

mycursor = connection.cursor()

Q1 = "CREATE TABLE Recipes (recipeID int PRIMARY KEY AUTO_INCREMENT, recipename VARCHAR(100), instructions VARCHAR(7000), ingredients VARCHAR(7000), dietaries VARCHAR(7000), links VARCHAR(7000))"#Creates the Recipe table
Q2 = "INSERT INTO Recipes (recipename, instructions, ingredients, dietaries, links) VALUES (%s, %s, %s, %s , %s)"#Query for inserting data in to database

Q3 = "CREATE TABLE Accounts (acountID int PRIMARY KEY AUTO_INCREMENT, username VARCHAR(100), pwd VARCHAR(7000), email VARCHAR(100), firstname VARCHAR(100), secondname VARCHAR(100), age int)"#Creates Accounts table

Q4 = "CREATE TABLE Admins (AdminID int PRIMARY KEY AUTO_INCREMENT, username VARCHAR(100), acountID int)"#Creates Admin table
# mycursor.execute(Q1)
# mycursor.execute(Q4)

Recipedata = [("Gluten-free pizza"
               , "Step 1: Heat the oven to 220C/200 fan/gas 7 and put two baking sheets inside. Step 2: Make the sauce: heat the oil in a small saucepan and cook the onion with a generous pinch of salt for 10 mins over a low heat until softened. Add the chopped tomatoes, purée and sugar and bring to a gentle simmer. Cook, uncovered, for 25 - 30 mins or until reduced and thick, stirring regularly. Blitz the sauce with a hand blender until smooth. Season to taste and stir through the basil. Allow to cool a little. Step 3: Make the dough: mix the flour, sugar, baking powder, salt and xanthan gum in a large mixing bowl. Make a well in the centre and pour in 250ml warm water and the olive oil. Combine quickly with your hands, to create a thick, wet, paste-like texture, adding an extra 20ml warm water if the dough feels a little dry. Store in an airtight container or covered bowl in the fridge for up to 24 hours before using. Lightly flour two more baking sheets. Split the dough into two and flatten with your fingers into 20 - 25cm rounds on the sheets. Step 4: Finish the bases with a thin layer of the sauce and torn up mozzarella. Place the baking sheets on top of the hot baking sheets in the oven and cook for 8 -10 mins or until crisp around the edges."  
               ,"400g gluten-free bread flour, 2 heaped tsp golden caster sugar, 2 tsp gluten-free baking powder, 1 tsp fine salt ,1 heaped tsp xanthan gum, 5 tbsp olive oil , For the sauce & topping ,2 tbsp olive oil, 1 small onion finely chopped, 1 x 400g can chopped tomatoes, 2 tbsp tomato purée, 1 tsp caster sugar, ½ small bunch basil leaves shredded, 2 x 125g balls buffalo mozzarella"
               , "Vegtarian" 
               ,"Gluten-freepizza.png")]#list of Recipe data

for x, Recipe in enumerate(Recipedata):#goes through each item in the recpie list and adds it to the databse
    mycursor.execute(Q2, Recipe)#Adds data to my tables

connection.commit()# makes sure the everything that happens to the databse is saved
