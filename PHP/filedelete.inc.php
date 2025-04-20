<?php
if (file_exists("currentaccount.json")) //checks if there is an  account json file 
{
    echo"yes";
    $path = dirname(__FILE__)."/currentaccount.json";
    unlink($path);
    header("Location: index.inc.php");
}
