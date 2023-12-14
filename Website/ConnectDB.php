<?php
//Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "online_learning_system";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>