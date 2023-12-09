<?php
include '../ConnectDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT * FROM users WHERE Email = '$email' AND UserName = '$username'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows == 1) {   
            session_start();
            $_SESSION["Email"] = $email;
            $_SESSION["UserName"] = $username;
            header("location: ResetPassword.php");
            exit();
        } else {
            $_SESSION["error_message"] = "Wrong email";
            echo "<script type='text/javascript'> alert('Wrong email'); window.location.href = 'ForgetPassword.php';</script>";
            exit();
        }
    } else {
        $_SESSION["error_message"] = "Error: " . $conn->error;
        header("location: ForgetPassword.php");
        exit();
    }
}
?>