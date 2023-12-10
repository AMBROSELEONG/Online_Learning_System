<?php
// 开始会话
session_start();

// 判断请求方法是否为 POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 连接数据库
    include '../ConnectDB.php';

    // 获取表单中的用户名和密码
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 使用预处理语句来查询数据库，防止 SQL 注入
    $stmt = $conn->prepare("SELECT UserID FROM users WHERE UserName = ? AND PasswordHash = ?");
    $stmt->bind_param("ss", $username, $password);

    // 执行查询
    $stmt->execute();

    // 获取查询结果
    $result = $stmt->get_result();

    // 判断查询结果是否正确
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // 将用户ID存入 session
        $_SESSION['UserID'] = $row['UserID'];

        // 重定向到主页面
        header("location: ../MainPage/MainPage.php");
        exit();
    } else {
        // 提示错误信息
        echo "<script type='text/javascript'>alert('Wrong username or password'); window.location.href = 'Login.php';</script>";
        exit();
    }

    // 关闭连接和语句
    $stmt->close();
    $conn->close();
}
?>