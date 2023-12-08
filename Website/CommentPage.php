<?php
include 'ConnectDB.php';

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

        /* 默认情况下的星星样式 */
        .star {
            font-size: 20px;
            cursor: pointer;
        }

        /* 选中状态的星星样式 */
        .star.selected {
            color: gold;
        }
    </style>
</head>

<body style="background-image: url(img/comment.jpg);">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(60, 60, 60); padding: 1% 4%;">
        <div class="container">
            <a class="navbar-brand" href="MainPage.php">Home</a>
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
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating:</label>
                    <div class="rating">
                        <input type="hidden" id="rating" name="rating" value="0">
                        <span class="star" data-rating="1">&#9733;</span>
                        <span class="star" data-rating="2">&#9733;</span>
                        <span class="star" data-rating="3">&#9733;</span>
                        <span class="star" data-rating="4">&#9733;</span>
                        <span class="star" data-rating="5">&#9733;</span>
                    </div>
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
                        echo '<li class="list-group-item">
                    <strong>' . htmlspecialchars($row['UserName']) . ':</strong><br>' . htmlspecialchars($row['CommentContent']) . '<br>' . htmlspecialchars($row['CourseName']) . '<br>';

                        // 添加星级评分
                        echo '<div class="rating">';
                        for ($i = 1; $i <= 5; $i++) {
                            echo '<span class="star" data-rating="' . $i . '">&#9733;</span>';
                        }
                        echo '</div>';

                    }
                } else {
                    echo "No comments yet.";
                }

                $conn->close();
                ?>
            </ul>
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
                var rating =document.getElementById('rating').value;
                var currentTime = getCurrentTime();

                var formData = new FormData(this);

                // 创建留言元素
                var li = document.createElement('li');
                li.className = 'list-group-item';
                li.innerHTML = '<strong>' + name + ':</strong><br> ' + comment + "<br>" + course + '<br>'+rating+'--Star<br>'+'<small>Posted on ' + currentTime + '</small>';
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
        <script>
            // 获取所有评分星星元素
            var stars = document.querySelectorAll('.star');
            var ratingInput = document.getElementById('rating');

            // 为每个星星添加点击事件监听器
            stars.forEach(function (star) {
                star.addEventListener('click', function () {
                    var rating = this.getAttribute('data-rating'); // 获取点击的星星的评分

                    // 更新隐藏的评分输入字段的值
                    ratingInput.value = rating;
                    stars.forEach(function (s) {
                        if (s.getAttribute('data-rating') <= rating) {
                            s.classList.add('selected');
                        } else {
                            s.classList.remove('selected');
                        }
                    });
                });
            });

        </script>

</body>

</html>