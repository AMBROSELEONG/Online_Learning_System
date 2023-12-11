<?php
// 连接数据库
include '../ConnectDB.php';
// 开启会话
session_start();

if (isset($_POST['submit'])) {

    // 获取输入的密码
    $password = $_POST['password'];
    // 获取重复输入的密码
    $confpassword = $_POST['repeatpassword'];

    // 判断两次输入的密码是否一致
    if ($password !== $confpassword) {
        echo "<script>alert('Passwords do not match'); window.location.href = 'ResetPassword.php';</script>";
    } else {
        // 判断会话变量是否设置
        if (isset($_SESSION["Email"]) && isset($_SESSION['UserName'])) {
            // 获取会话变量中的邮箱和用户名
            $email = mysqli_real_escape_string($conn, $_SESSION["Email"]);
            $username = mysqli_real_escape_string($conn, $_SESSION['UserName']);

            // 查询数据库中是否有该邮箱和用户名
            $select_query = "SELECT * FROM users WHERE Email = '$email' AND UserName = '$username'";
            $run_select_query = mysqli_query($conn, $select_query);

            // 判断查询结果是否正确
            if ($run_select_query && mysqli_num_rows($run_select_query) === 1) {
                // 获取查询结果
                $user_data = mysqli_fetch_assoc($run_select_query);
                // 获取用户ID
                $user_id = $user_data['UserID'];

                // 获取加密后的密码
                $hashed_password = $password;

                // 更新密码
                $update_posts = "UPDATE users SET PasswordHash='$hashed_password' WHERE UserID='$user_id'";
                $run_update = mysqli_query($conn, $update_posts);

                // 判断更新是否成功
                if ($run_update) {
                    echo "<script>alert('Password Update Successful'); window.location.href = '../Login/Login.php';</script>";
                    // 获取当前时间
                    $currentTime = date("Y-m-d H:i:s");
                    // 插入新数据到 userresetpassword 表格
                    $insert_query = "INSERT INTO userresetpassword (UserID, UserName, NewPassword, Email, ResetDate) VALUES ('$user_id', '$username', '$hashed_password', '$email', '$currentTime')";
                    $run_insert_query = mysqli_query($conn, $insert_query);
                    // 判断插入是否成功
                    if ($run_insert_query) {
                        // 如果成功插入，提示密码更新成功，并跳转到登录页面
                        echo "<script>alert('Password Update Successful'); window.location.href = '../Login/Login.php';</script>";
                        exit();
                    } else {
                        // 如果插入失败，提示错误并保留在重置密码页面
                        echo "<script>alert('Error updating password'); window.location.href = 'ResetPassword.php';</script>";
                        exit();
                    }
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