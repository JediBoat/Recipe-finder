import mysql.connector

connection = mysql.connector.connect(host='sql8.freesqldatabase.com',
                                     user='',
                                    password='',
                                    database=""
                                    )#Connect to the database

mycursor = connection.cursor()

Q1 = "CREATE TABLE Recipes (recipeID int PRIMARY KEY AUTO_INCREMENT, recipename VARCHAR(100), instructions VARCHAR(7000), dietaries VARCHAR(7000),  links VARCHAR(7000))"#Creates the Recipe table
Q2 = "INSERT INTO Recipes (recipename, instructions, dietaries, links) VALUES (%s, %s, %s, %s)"#Query for inserting data in to database

Q3 = "CREATE TABLE Accounts (acountID int PRIMARY KEY AUTO_INCREMENT, username VARCHAR(100), pwd VARCHAR(7000), email VARCHAR(100))"#Creates Accounts table

Recipedata = [("FOOD", "Cook", "Veg" ,"href blah blah")]#list of Recipe data

for x, Recipe in enumerate(Recipedata):#goes through each item in the recpie list and adds it to the databse
    mycursor.execute(Q2, Recipe)#Adds data to my tables

connection.commit()# makes sure the everything that happens to the databse is saved
