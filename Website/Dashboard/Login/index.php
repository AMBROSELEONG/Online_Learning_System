<?php
// Start the session
session_start();
$error = "";
$success = "";
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Connect to the database
    include '../../ConnectDB.php';

    // Get the username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a prepared statement to select the user from the database
    $stmt = $conn->prepare("SELECT AdminID FROM admin WHERE UserName = ? AND Password = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result of the query
    $result = $stmt->get_result();

    // Check if the username and password match an existing user
    if ($result->num_rows == 1) {
        // If the username and password match an existing user, set the user ID in the session and redirect to the main page
        $row = $result->fetch_assoc();
        $_SESSION['AdminID'] = $row['AdminID'];
        $_SESSION['UserName'] = $row['UserName'];
        $_SESSION['success'] = $success;

        echo "<script>alert('Login Successful!'); window.location.href = '../Dashboard.php'</script>";
        exit();
    } else {
        // If the username and password do not match an existing user, alert the user and redirect to the login page
        $error = "Wrong username or password";
        $_SESSION['error'] = $error;
        header("location: Login.php");
        exit();
    }

    // Close the prepared statement and the connection
    $stmt->close();
    $conn->close();
}
?>