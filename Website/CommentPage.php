<?php
$servername = "127.0.0.1";
$user = "root";
$pass = "";
$dbName = "online_learning_system";

$conn = new mysqli($servername, $user, $pass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM comments ORDER BY CommentDate DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Board</title>
    <!-- 引入Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        .comment-box {
            margin-top: 20px;
        }
    </style>
</head>

<body style="background-image: url(img/comment.jpg);">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(60, 60, 60); padding: 1% 4%;">
        <div class="container">
            <a class="navbar-brand" href="MainPage.html">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <!-- Add your navigation links here -->
                    <li class="nav-item">
                        <a class="nav-link" href="CoursePage.html" style="font-size: 20px;">Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="QuizList.html" style="font-size: 20px;">Quiz</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" style="font-size: 20px;">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var navbarToggler = document.querySelector(".navbar-toggler");
            var navbarCollapse = document.querySelector(".navbar-collapse");

            navbarToggler.addEventListener("click", function () {
                navbarCollapse.classList.toggle("show");
            });
        });
    </script>

    <div class="container">
        <h1 class="mt-5">Comment Board</h1>

        <div class="comment-box">
            <form id="commentForm" action="CommentPHP.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Content:</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="course" class="form-label">Course:</label>
                    <textarea class="form-control" id="course" name="course" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- 留言列表 -->
        <div class="comment-box mt-4">
            <h3>Comment List</h3>
            <ul id="commentList" class="list-group">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<li class="list-group-item"><strong>' . htmlspecialchars($row['UserName']) . ':</strong><br>' . htmlspecialchars($row['CommentContent']) . '<br>' . htmlspecialchars($row['CourseName']) . '<br><small>Posted on ' . htmlspecialchars($row['CommentDate']) . '</small></li>';
                    }
                } else {
                    echo "No comments yet.";
                }
                ?>
            </ul>
        </div>

    </div>

    <!-- 引入Bootstrap JS 和 Popper.js（用于一些组件的工作）-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function getCurrentTime() {
            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1; // Month starts from 0
            var year = currentDate.getFullYear();
            var hours = currentDate.getHours();
            var minutes = currentDate.getMinutes();
            var seconds = currentDate.getSeconds();

            // 格式化时间
            var formattedTime = year + '-' + addZeroBefore(month) + '-' + addZeroBefore(day) + ' ' + addZeroBefore(hours) + ':' + addZeroBefore(minutes) + ':' + addZeroBefore(seconds);
            return formattedTime;
        }

        // 为单个数字添加前导零
        function addZeroBefore(number) {
            return (number < 10 ? '0' : '') + number;
        }

        // 监听表单提交事件
        document.getElementById('commentForm').addEventListener('submit', function (event) {
            event.preventDefault();

            // 获取姓名和留言内容
            var name = document.getElementById('name').value;
            var comment = document.getElementById('comment').value;
            var course = document.getElementById('course').value;
            var currentTime = getCurrentTime();

            var formData = new FormData(this);

            // 创建留言元素
            var li = document.createElement('li');
            li.className = 'list-group-item';
            li.innerHTML = '<strong>' + name + ':</strong><br> ' + comment + "<br>" + course + '<br><small>Posted on ' + currentTime + '</small>';
            // 将留言元素添加到留言列表中
            document.getElementById('commentList').appendChild(li);

            // 清空表单
            document.getElementById('name').value = '';
            document.getElementById('comment').value = '';
            document.getElementById('course').value = '';

            fetch('Comment.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    // Handle the server response here if needed
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>

</body>

</html>

<?php
$conn->close();
?>