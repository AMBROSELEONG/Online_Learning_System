<?php
    include '../ConnectDB.php';
    include '../Session.php';

    $email = $_POST['email'];

    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT * FROM users WHERE Email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION["email"] = $email;
        header("location: ResetPassword.php");

    $conn->close();

    } else{
        echo "<script type='text/javascript'> alert('Wrong username or password'); ; window.location.href = 'ForgetPassword.php';</script>";
    }
    $conn->close();

?>
?>