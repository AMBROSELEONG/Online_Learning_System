<?php
// 连接数据库
include '../ConnectDB.php';
// 连接会话
include '../Session.php';

// 判断会话是否已存在用户ID
if (isset($_SESSION['UserID'])) {
    // 获取用户ID
    $userID = $_SESSION['UserID'];

    // 查询数据库获取用户名，邮箱，电话号码
    $query = "SELECT UserName, Email, ContactNumber FROM users WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    // 判断查询结果是否为空
    if ($result->num_rows > 0) {
        // 获取用户信息
        $userDetails = $result->fetch_assoc();
       
        // 获取用户名，邮箱，电话号码
        $name = $userDetails['UserName'];
        $email = $userDetails['Email'];
        $phone = $userDetails['ContactNumber'];
    }
    // 关闭查询语句
    $stmt->close();
    // 关闭数据库连接
    $conn->close();
}
?>