<?php
include '../ConnectDB.php';
session_start();
$error = "";
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

            $_SESSION["Email"] = $email;
            $_SESSION["UserName"] = $username;
            echo "<script>alert('Verify Successful!'); window.location.href = 'ResetPassword.php'</script>";
            // Redirect the user to the ResetPassword page
            exit();
        } else {
            // Store an error message in the session if the username and email don't exist
            $_SESSION["error"] = "Wrong UserName And Email";
            header("location: ForgetPassword.php");
            // Display an error message to the user
            exit();
        }
    } else {
        // Store an error message in the session if there was an error querying the database
        $_SESSION["error"] = "Error: " . $conn->error;
        // Redirect the user to the ForgetPassword page
        header("location: ForgetPassword.php");
        exit();
    }
}
?>