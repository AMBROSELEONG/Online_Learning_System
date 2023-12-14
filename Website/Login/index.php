<?php
// Start the session
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Connect to the database
    include '../ConnectDB.php';

    // Get the username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a prepared statement to select the user from the database
    $stmt = $conn->prepare("SELECT UserID FROM users WHERE UserName = ? AND PasswordHash = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result of the query
    $result = $stmt->get_result();

    // Check if the username and password match an existing user
    if ($result->num_rows == 1) {
        // If the username and password match an existing user, set the user ID in the session and redirect to the main page
        $row = $result->fetch_assoc();

        $_SESSION['UserID'] = $row['UserID'];

        header("location: ../MainPage/MainPage.php");
        exit();
    } else {
        // If the username and password do not match an existing user, alert the user and redirect to the login page
        echo "<script type='text/javascript'>alert('Wrong username or password'); window.location.href = 'Login.php';</script>";
        exit();
    }

    // Close the prepared statement and the connection
    $stmt->close();
    $conn->close();
}
?>