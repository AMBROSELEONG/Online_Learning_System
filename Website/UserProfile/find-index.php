<?php
// 连接数据库
include '../ConnectDB.php';
// 获取用户会话
include '../Session.php';

// 查询数据库中指定用户ID的用户信息
$sql = "SELECT * FROM userprofile WHERE UserID = $userID";

// 执行查询
$result = $conn->query($sql);

// 检查查询是否失败
if ($result === false) {
    echo "Error: " . $conn->error;
} else {
    // 检查查询结果是否为空
    if ($result->num_rows > 0) {

        // 获取查询结果
        $row = $result->fetch_assoc();
        $image = $row['UserImage'];
        $username = $row['UserName'];
        $collegename = $row['CollegeName'];
        $gmail = $row['Email'];
        $phone = $row['Phone'];
        $about = $row['About'];
    } else {
        // 查询结果为空，设置用户信息为空
        $username = "None";
        $collegename = "None";
        $gmail = "None";
        $phone = "None";
        $about = "None";
    }
}

// 关闭数据库连接
$conn->close();
?>