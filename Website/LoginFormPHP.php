<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'ConnectDB.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    // 使用预处理语句来查询数据库，防止 SQL 注入
    $stmt = $conn->prepare("SELECT UserID FROM users WHERE UserName = ? AND PasswordHash = ?");
    $stmt->bind_param("ss", $username, $password);

    // 执行查询
    $stmt->execute();

    // 获取查询结果
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // 将用户ID存入 session
        $_SESSION['UserID'] = $row['UserID'];

        header("location: MainPage.php");
        exit();
    } else {
        echo "<script type='text/javascript'>alert('Wrong username or password'); window.location.href = 'LoginForm.php';</script>";
        exit();
    }

    // 关闭连接和语句
    $stmt->close();
    $conn->close();
}
?>