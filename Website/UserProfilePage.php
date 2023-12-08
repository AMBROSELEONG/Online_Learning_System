<?php
include 'UserProfileFindData.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="UserProfile.css">
    <link rel="stylesheet" href="icon/iconfont.css">
</head>

<body>
    <div class="container-upper">
        <div class="container-right">
            <button>Profile</button>
            <button onclick="window.location.href='UserResume.html'"
                script="window.location.replace('UserRusume.html')">Resume</button>
            <button onclick="window.location.href='UserHistory.html'"
                script="window.location.replace('UserHistory.html')">History</button>
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
    <form class="modal-content animate" action="UserProfilePHP.php" method="post" enctype="multipart/form-data">
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
    function fileChange(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var imgShow = document.getElementById('img-show');
                imgShow.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

</html>