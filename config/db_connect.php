<?php
// MySQLi or PDO

// connection to database
$conn = mysqli_connect("localhost","root","","to-dos");

// check connection
if (!$conn) {
    die("Connection Failed: " . $conn->connect_error);
}


?>