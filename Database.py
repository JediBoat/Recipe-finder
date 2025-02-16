import mysql.connector

connection = mysql.connector.connect(host='sql8.freesqldatabase.com',
                                     user='',
                                    password='',
                                    database=""
                                    )#Connect to the database

mycursor = connection.cursor()

Q1 = "CREATE TABLE Recipes (RecipeID int PRIMARY KEY AUTO_INCREMENT, Recipename VARCHAR(100), Instructions VARCHAR(7000), Dietaries VARCHAR(7000),  Links VARCHAR(7000))"#Creates the Recipe table
Q2 = "INSERT INTO Recipes (Recipename, Instructions, Dietaries, Links) VALUES (%s, %s, %s, %s)"#Query for inserting data in to database

Recipedata = [("FOOD", "Cook", "Veg" ,"href blah blah")]#list of Recipe data

for x, Recipe in enumerate(Recipedata):#goes through each item in the recpie list and adds it to the databse
    mycursor.execute(Q2, Recipe)#Adds data to my tables

connection.commit()# makes sure the everything that happens to the databse is saved
