<?php
// Start the session
session_start();

// Check if the user is logged in by checking if the UserID session variable is set
if (isset($_SESSION['UserID'])) {
    // If the UserID session variable is set, store it in the $userID variable
    $userID = $_SESSION['UserID'];
} else {
    // If the UserID session variable is not set, redirect the user to the login page
    header("location: ../Login/Login.php");
    exit();
}
?>