<?php
include '../ConnectDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单数据
    $username = $_POST['username'];
    $email = $_POST['email'];
    // 转义字符串
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);

    // 查询数据库
    $sql = "SELECT * FROM users WHERE Email = '$email' AND UserName = '$username'";
    $result = $conn->query($sql);

    if ($result) {
        // 判断查询结果
        if ($result->num_rows == 1) {   
            // 设置session
            session_start();
            $_SESSION["Email"] = $email;
            $_SESSION["UserName"] = $username;
            // 重定向
            header("location: ResetPassword.php");
            exit();
        } else {
            // 错误信息
            $_SESSION["error_message"] = "Wrong email";
            // 弹出错误信息
            echo "<script type='text/javascript'> alert('Wrong email'); window.location.href = 'ForgetPassword.php';</script>";
            exit();
        }
    } else {
        // 错误信息
        $_SESSION["error_message"] = "Error: " . $conn->error;
        // 重定向
        header("location: ForgetPassword.php");
        exit();
    }
}
?>