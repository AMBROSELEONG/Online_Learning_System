<?php
// Include the connection to the database
include '../ConnectDB.php';

// Start the session
session_start();

$errors = []; // Error variable declaration

if (isset($_POST['submit'])) {

    // Store the password and confirm password from the form
    $password = $_POST['password'];
    $confpassword = $_POST['repeatpassword'];

    // Function to validate the password format
    function validatePassword($password)
    {
        $errors = [];
        if (strlen($password) < 8) {
            $errors[] = "Password length must be at least 8 characters.";
        }

        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = "Password should contain at least one lowercase letter.";
        }

        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Password should contain at least one uppercase letter.";
        }

        if (!preg_match('/\d/', $password)) {
            $errors[] = "Password should contain at least one number.";
        }

        if (!preg_match('/[^a-zA-Z\d]/', $password)) {
            $errors[] = "Password should contain at least one special character.";
        }
        return $errors;
    }

    // Validate password format
    $passwordErrors = validatePassword($password);

    // Check if the passwords match
    function verify($password)
    {
        $errors = [];
        if ($password !== $_POST['repeatpassword']) {
            $errors[] = "Passwords do not match.";
        }
        return $errors;
    }
    $inputErrors = verify($password);

    // Store errors in $errors if any
    $errors = array_merge($passwordErrors, $inputErrors);

    if (empty($errors)) {
        // Check if the session variables are set
        if (isset($_SESSION["Email"]) && isset($_SESSION['UserName'])) {
            // Store the session variables in the variables
            $email = mysqli_real_escape_string($conn, $_SESSION["Email"]);
            $username = mysqli_real_escape_string($conn, $_SESSION['UserName']);

            // Select the user from the database
            $select_query = "SELECT * FROM users WHERE Email = '$email' AND UserName = '$username'";
            $run_select_query = mysqli_query($conn, $select_query);

            // Check if the user was found
            if ($run_select_query && mysqli_num_rows($run_select_query) === 1) {
                // Store the user data in the user_data variable
                $user_data = mysqli_fetch_assoc($run_select_query);
                $user_id = $user_data['UserID'];

                // Store the hashed password in the variable
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Update the user's password in the database
                $update_posts = "UPDATE users SET PasswordHash='$hashed_password' WHERE UserID='$user_id'";
                $run_update = mysqli_query($conn, $update_posts);

                // Check if the update was successful
                if ($run_update) {
                    // Alert the user and redirect them to the Login page
                    echo "<script>alert('Password Update Successful'); window.location.href = '../Login/Login.php';</script>";
                    // Store the current time in the variable
                    $currentTime = date("Y-m-d H:i:s");
                    // Insert the user's data into the userresetpassword table
                    $insert_query = "INSERT INTO userresetpassword (UserID, UserName, NewPassword, Email, ResetDate) VALUES ('$user_id', '$username', '$hashed_password', '$email', '$currentTime')";
                    $run_insert_query = mysqli_query($conn, $insert_query);

                    // Check if the insert was successful
                    if ($run_insert_query) {
                        // Alert the user and redirect them to the Login page
                        echo "<script>alert('Password Update Successful'); window.location.href = '../Login/Login.php';</script>";
                        exit();
                    } else {
                        // If unsuccessful, alert the user and redirect them to the ResetPassword page
                        $_SESSION['error'] = 'Error updating password';
                        header("location: ResetPassword.php");
                        exit();
                    }
                } else {
                    // If unsuccessful, alert the user and redirect them to the ResetPassword page
                    $_SESSION['error'] = 'Error updating password';
                    header("location: ResetPassword.php");
                    exit();
                }
            } else {
                // If the user was not found, alert the user and redirect them to the ResetPassword page
                $_SESSION['error'] = 'No email or username was found';
                header("location: ResetPassword.php");
                exit();
            }
        } else {
            // If the session variables are not set, alert the user and redirect them to the ResetPassword page
            $_SESSION['error'] = 'Session variables are not set';
            header("location: ResetPassword.php");
            exit;
        }
    } else {
        $_SESSION['error'] = $errors;
        header("location: ResetPassword.php");
        exit;
    }
}
?>