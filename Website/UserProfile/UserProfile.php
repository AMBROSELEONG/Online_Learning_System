<?php
include 'find-index.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="UserProfile.css">
    <link rel="stylesheet" href="../icon/iconfont.css">
</head>

<body>
    <div class="container-upper">
        <div class="container-right">
            <button>Profile</button>
            <button onclick="window.location.href='../UserResume/UserResume.php'"
                script="window.location.replace('../UserResume/UserRusume.php')">Resume</button>
            <button onclick="window.location.href='../UserHistory/UserHistory.html'"
                script="window.location.replace('../UserHistory/UserHistory.html')">History</button>
        </div>
    </div>
    <img src="<?php echo $image; ?>" alt="User Image" class="user-img">
    <div class="container-lower">
        <input type="" style="display: none;"> <!--不显示，单纯占地-->
        <button class="edit-profile"
            onclick="document.getElementById('id01').style.display='block'; document.getElementById('fileInput').click()">Edit
            Profile</button>

        <div class="container-content">
            <div class="content-left">
                <h1>User Name:
                    <?php echo $username; ?>
                </h1>
                <h1>Gmail:
                    <?php echo $gmail; ?>
                </h1>
            </div>
            <div class="content-right">
                <h1>College Name:
                    <?php echo $collegename; ?>
                </h1>
                <h1>Phone Number:
                    <?php echo $phone; ?>
                </h1>
            </div>
            <hr>
            <div class="about-me">
                <h1>About Me</h1>
                <h2>
                    <?php echo $about; ?>
                </h2>
            </div>
        </div>
    </div>
</body>

<div id="id01" class="modal">
    <form class="modal-content animate" action="insert-index.php" method="post" enctype="multipart/form-data">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close"
                title="Close Modal">&times;</span>
            <img class="img-show" id="img-show"
                src="<?php echo !empty($image) ? $image : 'img/user_background.png'; ?>"
                style="width: 20rem; height: 20rem; border: 1px solid black; border-radius: 50%; margin: 0 auto; "><br>
            <input type="file" id="img-input" name="userImage" onchange="fileChange(this)"
                accept=".jpg, .jpeg, .png, .gif">
        </div>
        <div class="container">
            <label for="Username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="Username" id="Username"
                value="<?php echo $username; ?>">

            <label for="CollegeName"><b>College Name</b></label>
            <input type="text" placeholder="Enter College Name" name="CollegeName" id="CollegeName"
                value="<?php echo $collegename; ?>">

            <label for="Gmail"><b>Gmail</b></label>
            <input type="text" placeholder="Enter Gmail" name="Gmail" id="Gmail" value="<?php echo $gmail; ?>">

            <label for="Phone"><b>Phone Number</b></label>
            <input type="text" placeholder="Enter Phone" name="Phone" id="Phone" value="<?php echo $phone; ?>">

            <br>
            <label for="About"><b>About Me</b></label>
            <br>
            <textarea name="About" id="About" cols="30rem" rows="10"><?php echo $about; ?></textarea>
            <br>
            <button type="submit" name="save"
                style="width: 20rem; height: 5rem; border: none; background-color: rgb(255, 140, 0);">Save</button>
        </div>
    </form>
</div>

<script>
    // 当文件发生变化时，触发函数
    function fileChange(input) {
        // 判断是否有文件存在
        if (input.files && input.files[0]) {
            // 创建文件读取对象
            var reader = new FileReader();

            // 当文件读取完毕时，触发回调函数
            reader.onload = function (e) {
                // 获取图片元素
                var imgShow = document.getElementById('img-show');
                // 将文件内容赋值给图片元素
                imgShow.src = e.target.result;
            };

            // 读取文件内容
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</html>