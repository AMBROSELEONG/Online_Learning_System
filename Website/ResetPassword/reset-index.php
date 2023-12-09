<?php
include '../ConnectDB.php';
session_start();

if (isset($_POST['submit'])) {

    $password = $_POST['password'];
    $confpassword = $_POST['repeatpassword'];

    if ($password !== $confpassword) {
        echo "<script>alert('Passwords do not match'); window.location.href = 'ResetPassword.php';</script>";
    } else {
        if (isset($_SESSION["Email"]) && isset($_SESSION['UserName'])) {
            $email = mysqli_real_escape_string($conn, $_SESSION["Email"]);
            $username = mysqli_real_escape_string($conn, $_SESSION['UserName']);

            $select_query = "SELECT * FROM users WHERE Email = '$email' AND UserName = '$username'";
            $run_select_query = mysqli_query($conn, $select_query);

            if ($run_select_query && mysqli_num_rows($run_select_query) === 1) {
                $user_data = mysqli_fetch_assoc($run_select_query);
                $user_id = $user_data['UserID'];

                $hashed_password = $password;

                $update_posts = "UPDATE users SET PasswordHash='$hashed_password' WHERE UserID='$user_id'";
                $run_update = mysqli_query($conn, $update_posts);

                if ($run_update) {
                    echo "<script>alert('Password Update Successful'); window.location.href = '../Login/Login.php';</script>";
                    exit();
                } else {
                    echo "<script>alert('Error updating password'); window.location.href = 'ResetPassword.php';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('No email or username was found'); window.location.href = 'ResetPassword.php';</script>";
            }
        } else {
            echo "<script>alert('Session variables are not set'); window.location.href = 'ResetPassword.php';</script>";
        }
    }
}
?>