<?php
// 开始会话
session_start();
// 检查是否有UserID
if (isset($_SESSION['UserID'])) {
    // 如果有，则获取UserID
    $userID = $_SESSION['UserID'];
} else {
    // 如果没有，则跳转到登录页面
    header("location: ../Login/Login.php");
    exit();
}
?>