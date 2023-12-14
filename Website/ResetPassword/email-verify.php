<?php
include '../ConnectDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and email from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    // Escape the username and email to prevent SQL injections
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);

    // Query the database to check if the username and email exist
    $sql = "SELECT * FROM users WHERE Email = '$email' AND UserName = '$username'";
    $result = $conn->query($sql);

    if ($result) {
        // Check if the username and email exist in the database
        if ($result->num_rows == 1) {   
            // Start the session and store the username and email in the session
            session_start();
            $_SESSION["Email"] = $email;
            $_SESSION["UserName"] = $username;
            // Redirect the user to the ResetPassword page
            header("location: ResetPassword.php");
            exit();
        } else {
            // Store an error message in the session if the username and email don't exist
            $_SESSION["error_message"] = "Wrong email";
            // Display an error message to the user
            echo "<script type='text/javascript'> alert('Wrong email'); window.location.href = 'ForgetPassword.php';</script>";
            exit();
        }
    } else {
        // Store an error message in the session if there was an error querying the database
        $_SESSION["error_message"] = "Error: " . $conn->error;
        // Redirect the user to the ForgetPassword page
        header("location: ForgetPassword.php");
        exit();
    }
}
?>