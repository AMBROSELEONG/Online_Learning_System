<?php
include '../Session.php';
// 声明一个空数组用于存储错误信息
$errors = [];
// 判断请求方式是否为POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 获取表单中的数据
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $course = $_POST['course'];
    // 获取当前时间
    $post_time = date('Y-m-d H:i:s');

    // 连接数据库
    include '../ConnectDB.php';
    // 将评论内容插入数据库
    $stmt = $conn->prepare("INSERT INTO comments (UserID, UserName, CommentContent, CourseName, CommentDate) VALUES (?,?,?,?,?)");
    $stmt->bind_param("issss", $userID, $name, $comment, $course, $post_time);

    // 执行插入操作
    if ($stmt->execute()) {
        // 插入成功
        echo "Comment added successfully!";
    } else {
        // 插入失败
        echo "Error: " . $stmt->error;
    }

    // 查询数据库中的评论
    $sql = "SELECT * FROM comments ORDER BY CommentDate DESC";
    $result = $conn->query($sql);

    // Output each comment
    // 输出每个评论
    if ($result->num_rows > 0) {
        echo '<ul id="commentList" class="list-group">';
        while ($row = $result->fetch_assoc()) {
            echo '<li class="list-group-item"><strong>' . htmlspecialchars($row['UserName']) . ':</strong><br>' . htmlspecialchars($row['CommentContent']) . '<br>' . htmlspecialchars($row['CourseName']) . '<br><small>Posted on ' . htmlspecialchars($row['CommentDate']) . '</small></li>';
        }
        echo '</ul>';
    } else {
        echo "No comments yet.";
    }

    // 关闭数据库连接
    $stmt->close();
    $conn->close();
} else {
    // 处理错误信息
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}
?>