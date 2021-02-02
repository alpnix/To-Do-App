<?php 



if (isset($_GET["submit"])) {
    echo "Email: " . $_GET["email"]."<br>";
    echo "Task Name: " . $_GET["taskName"]."<br>";
    echo "Short Description: " . $_GET["shortDesc"]."<br>";
}

// errors associative array
// echo "Email: " . htmlspecialchars($_POST["email"])."<br>";
// echo "Task Name: " . htmlspecialchars($_POST["taskName"])."<br>";
// echo "Short Description: " .htmlspecialchars($_POST["shortDesc"])."<br>";  
// validating email with builtin functions
if (empty($_POST["email"])) {
    $errors["email"] = "You should enter an email!";
} else {
    $email = $_POST["email"];
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Your email should be in the correct format!";
    }
}
// validating the task name
if (empty($_POST["taskName"])) {
    $errors["name"] = "Please enter a name!";
} else {
    $task = $_POST["taskName"];
    if (!preg_match("/^[a-zA-Z\s'!,.]+$/",$task)) {
        $errors["name"] = "Your task name should contain letters and spaces only!";
    }
}
// validating short desc
if (empty($_POST["shortDesc"])) {
    $errors["desc"] = "You should enter a short description about the task!"; 
} else {
    $desc = $_POST["shortDesc"];
    if (!preg_match("/^[a-zA-Z\s'.!,]+$/",$desc)) {
        $errors["desc"] = "Short description should only contain letters and spaces!";
    }
}   
// evaluate if the form is valid or not
if (array_filter($errors)) {
    $formValid = 0;
    // not valid, not redirect
} else {
    $formValid = 1;
    header("Location: index.php");
}






?>