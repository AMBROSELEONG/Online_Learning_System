<?php
// Start the session
session_start();

// Set session timeout period in seconds (e.g., 30 minutes)
$inactiveTimeout = 1800; // 30 minutes

// Check if the user is logged in by checking if the UserID session variable is set
if (isset($_SESSION['UserID'])) {
    // If the UserID session variable is set, check for the last activity time
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactiveTimeout)) {
        // User has been inactive for too long, clear the session and redirect to login
        session_unset();
        session_destroy();
        header("location: ../Login/Login.php");
        exit();
    }

    // Update the last activity time to the current time
    $_SESSION['last_activity'] = time();

    // Store UserID in the $userID variable
    $userID = $_SESSION['UserID'];
} else {
    // If the UserID session variable is not set, redirect the user to the login page
    header("location: ../Login/Login.php");
    exit();
}

?>