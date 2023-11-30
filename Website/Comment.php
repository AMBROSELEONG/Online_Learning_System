<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $course = $_POST['course'];
    $post_time = date('Y-m-d H:i:s');

    if (empty($errors)) {
        $servername = "127.0.0.1";
        $user = "root";
        $pass = "";
        $dbName = "online_learning_system";

        $conn = new mysqli($servername, $user, $pass, $dbName);
    // 建立与数据库的连接（示例使用 mysqli）

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // 将评论内容插入数据库
        $stmt = $conn->prepare("INSERT INTO comments (UserName, CommentContent, CourseName, CommentDate) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $name, $comment, $course, $post_time);

        if ($stmt->execute()) {
            // 插入成功
            echo "Comment added successfully!";
        } else {
            // 插入失败
            echo "Error: " . $stmt->error;
        }

        $sql = "SELECT * FROM comments ORDER BY CommentDate DESC";
        $result = $conn->query($sql);
        
        // Output each comment
        if ($result->num_rows > 0) {
            echo '<ul id="commentList" class="list-group">';
            while ($row = $result->fetch_assoc()) {
                echo '<li class="list-group-item"><strong>' . htmlspecialchars($row['UserName']) . ':</strong><br>' . htmlspecialchars($row['CommentContent']) . '<br>' . htmlspecialchars($row['CourseName']) . '<br><small>Posted on ' . htmlspecialchars($row['CommentDate']) . '</small></li>';
            }
            echo '</ul>';
        } else {
            echo "No comments yet.";
        }

        $stmt->close();
        $conn->close();
    } else {
        // Handle errors (display or log them)
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>