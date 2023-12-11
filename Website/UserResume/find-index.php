<?php
// 连接数据库
include '../ConnectDB.php';
// 获取用户会话
include '../Session.php';

// 查询数据库中指定用户ID的用户信息
$sql = "SELECT * FROM userresume WHERE UserID = $userID";

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
        $experience = $row['Experience'];
        $education = $row['Education'];
        $skillset = $row['Skill'];
        $language = $row['Language_'];
    } else{
        $experience = "None";
        $education = "None";
        $skillset = "None";
        $language = "None";
    }
}
// 关闭数据库连接
$conn->close();
?>