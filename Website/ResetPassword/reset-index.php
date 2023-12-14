<?php
//include the connection to the database
include '../ConnectDB.php';
//start the session
session_start();

//check if the submit button was clicked
if (isset($_POST['submit'])) {

    //store the password and confirm password from the form
    $password = $_POST['password'];
    $confpassword = $_POST['repeatpassword'];

    //check if the passwords match
    if ($password !== $confpassword) {
        //if they don't match, alert the user and redirect them to the ResetPassword page
        echo "<script>alert('Passwords do not match'); window.location.href = 'ResetPassword.php';</script>";
    } else {
        //check if the session variables are set
        if (isset($_SESSION["Email"]) && isset($_SESSION['UserName'])) {
            //store the session variables in the variables
            $email = mysqli_real_escape_string($conn, $_SESSION["Email"]);
            $username = mysqli_real_escape_string($conn, $_SESSION['UserName']);

            //select the user from the database
            $select_query = "SELECT * FROM users WHERE Email = '$email' AND UserName = '$username'";
            $run_select_query = mysqli_query($conn, $select_query);

            //check if the user was found
            if ($run_select_query && mysqli_num_rows($run_select_query) === 1) {
                //store the user data in the user_data variable
                $user_data = mysqli_fetch_assoc($run_select_query);
                $user_id = $user_data['UserID'];

                //store the hashed password in the variable
                $hashed_password = $password;

                //update the user's password in the database
                $update_posts = "UPDATE users SET PasswordHash='$hashed_password' WHERE UserID='$user_id'";
                $run_update = mysqli_query($conn, $update_posts);

                //check if the update was successful
                if ($run_update) {
                    //if successful, alert the user and redirect them to the Login page
                    echo "<script>alert('Password Update Successful'); window.location.href = '../Login/Login.php';</script>";
                    //store the current time in the variable
                    $currentTime = date("Y-m-d H:i:s");
                    //insert the user's data into the userresetpassword table
                    $insert_query = "INSERT INTO userresetpassword (UserID, UserName, NewPassword, Email, ResetDate) VALUES ('$user_id', '$username', '$hashed_password', '$email', '$currentTime')";
                    $run_insert_query = mysqli_query($conn, $insert_query);
                    //check if the insert was successful
                    if ($run_insert_query) {
                        //if successful, alert the user and redirect them to the Login page
                        echo "<script>alert('Password Update Successful'); window.location.href = '../Login/Login.php';</script>";
                        exit();
                    } else {
                        //if unsuccessful, alert the user and redirect them to the ResetPassword page
                        echo "<script>alert('Error updating password'); window.location.href = 'ResetPassword.php';</script>";
                        exit();
                    }
                } else {
                    //if unsuccessful, alert the user and redirect them to the ResetPassword page
                    echo "<script>alert('Error updating password'); window.location.href = 'ResetPassword.php';</script>";
                    exit();
                }
            } else {
                //if the user was not found, alert the user and redirect them to the ResetPassword page
                echo "<script>alert('No email or username was found'); window.location.href = 'ResetPassword.php';</script>";
            }
        } else {
            //if the session variables are not set, alert the user and redirect them to the ResetPassword page
            echo "<script>alert('Session variables are not set'); window.location.href = 'ResetPassword.php';</script>";
        }
    }
}
?>