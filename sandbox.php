<?php

// ternary operators
$result = (5 > 4) ? "5 > 4" : "not 5 > 4";
echo "Ternary Operator: " . $result . "<br>";

// super globals
echo "SUPER_GLOBALS: <br>";
echo $_SERVER["SERVER_NAME"] . "<br>";
echo $_SERVER["REQUEST_METHOD"] . "<br>";
echo $_SERVER["SCRIPT_FILENAME"] . "<br>";
echo $_SERVER["PHP_SELF"] . "<br>";


// starting a session and directing to index to use session variables there
if (isset($_POST["submit"])) 
{
    // cookies 
    // setting up cookie for gender
    setcookie("gender",$_POST["gender"],time() + 86400);
    echo $_COOKIE["gender"] . "<br>";
    session_start();
    $_SESSION["name"] = $_POST["name"];

    header("Location: index.php");
}


// file system in PHP
$file = "D:\hello.txt";
if (!file_exists($file)) {
    return -1;
}
$quotes = readFile($file) ?? "Sorry, doesn't exist!";
echo $quotes . "<br>";
// copy file
# copy("file.txt", "destination.txt");
// absolute path 
echo realpath($file) . "<br>"; 
// file size
echo filesize($file) . "<br>";
// rename file
# rename($file,"newname.txt");

// make directory 
# mkdir("styles")



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandbox</title>
</head>
<body>  
    <form action="sandbox.php" method="POST">
        <input type="text" name="name">
        <input type="text" name="gender">
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>