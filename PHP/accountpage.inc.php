<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = $_POST["username"];//replace with form variable
    $pwd = $_POST["password"];//replace with form variable


    try 
    {
        require_once("dbapi.inc.php");//links file connects to the database


        $query = "SELECT * FROM Accounts WHERE email = '$email' AND pwd = '$pwd';";// selects all the data that matches 

        $statement = $pdo->prepare($query);

        

        $statement->execute();//submit data from user

        

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);//gets the reults
        

        $pdo = null;//closing of connection to database
        $statement = null;
        
    } 
    catch (PDOException $e) 
    {
        
        die(" Failed ". $e->getMessage());//it it fails it just terminates the script
        
    }
}
 


if(empty($results))
{

}
else
{
    foreach ($results as $result) 
    {
        $acountID = ($result["acountID"]);//retrieves results 
        $username = ($result["username"]);//need wait for html then adjust it
        $email = ($result["email"]);
        $firstname = ($result["firstname"]);
        $secondname = ($result["secondname"]);
        $age = ($result["age"]);
       
    }

    $path = "../account.json";
    $jsonData = [
                    [
                        "AccountID" =>  $acountID,
                        "Username" => $username,
                        "Email" => $email,
                        "Firstname" => $firstname,
                        "Secondname" => $secondname,
                        "Age" => $age
                    ]
                ];

                $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);

                $fp = fopen($path, "w");
                fwrite($fp, $jsonString);
                fclose($fp);

    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../main/styles.css"> <!-- Unsure if we will be using the same stylesheet or another for each seperate page -->
    <title>Dishcovery - My Account</title>
</head>
<body>

    <header>

        <div class="logo">Dishcovery</div>

        <nav class="menu-bar"> <!-- Menu bar for responsive and standard layout more may need to be added -->
            <ul>
                <li><a href="index.inc.php"> Home </a></li>
                <li><a href="../main/signinpage.html"> Sign Up/Login </a></li>
            </ul>
        </nav>

        <div class="searchbar-container"> <!-- Search bar container and classes unsure what else may be needed for the future functionality but ive added what I think is necessary-->
            <div class="search-bar">
                <form class="search-form">
                    <p class="search-title">Search Recipes:</p>
                    <input type="text" id="recipe" name="recipe" class="search-input-field" placeholder="Search Recipes.." required>
                    <button type="submit" class="search-btn">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>

    </header>

    <section class="accontainer">
        
        <form class="account-form"> <!-- Account page is currently just a display of the users name/email for now until its more clear for what is needed -->
            <div class="input-group">
                <input type="email" id="email" name="email" class="input-field" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input type="password" id="pwd" class="input-field" placeholder="Password" required>
            </div>
            <button type="submit" class="logoutbtn"><a href="signinpage.html"> Logout </a></button>
         </form>
        <a href="../main/delaccountpage.html">Delete your account?</a>

    </section>

    <section class="footer">
        
    </section>
</body>
</html>