<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About The Tutor</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <link rel="stylesheet" type="text/css" href="AboutTheTutor.css">
    <link rel="stylesheet" href="../icon/iconfont.css">
    <link rel="stylesheet" href="../icon2/iconfont.css">
    <link rel="stylesheet" href="../Dashboard/icon2/iconfont.css">
</head>

<body>
    <header>
        <div id="mySidepanel" class="sidepanel">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <a href="../MainPage/MainPage.php"><i class="iconfont icon-book1">
                    <p>Home</p>
                </i></a>
            <a href="../Course/CoursePage.php"><i class="iconfont icon-book1">
                    <p>Course</p>
                </i></a>
            <a href="../Quiz/QuizList.php"><i class="iconfont icon-shijuan">
                    <p>Quiz</p>
                </i></a>
            <a href="../ShoppingCart/ShoppingCart.php"><i class="iconfont icon-31gouwuchexuanzhong">
                    <p>Shopping Cart</p>
                </i></a>
            <a href="../UserProfile/UserProfile.php"><i class="iconfont icon-user">
                    <p>User Info</p>
                </i></a>
            <a href="../ContactUs/ContactUs.php"><i class="iconfont icon-dianhua">
                    <p>Contact Us</p>
                </i></a>
            <a href="../AboutUS/AboutUs.html"><i class="iconfont icon-guanyuwomen">
                    <p>About Us</p>
                </i></a>
            <a href="../Comment/Comment.php"><i class="iconfont icon-comment">
                    <p>Comment</p>
                </i></a>
            <a href="../Mailbox/Mailbox.php"><i class="iconfont icon-youxiang">
                    <p>Mailbox</p>
                </i></a>
            <a href="../Logout.php"><i class="iconfont icon-Logout">
                    <p>Logout</p>
                </i></a>
        </div>

        <button class="openbtn" onclick="openNav()">☰</button>

        <script>
            //Function to open the side panel
            function openNav() {
                //Get the element with the id "mySidepanel"
                document.getElementById("mySidepanel").style.width = "30rem";
            }

            //Function to close the side panel
            function closeNav() {
                //Get the element with the id "mySidepanel"
                document.getElementById("mySidepanel").style.width = "0rem";
            }
        </script>
        <div class="left-bar">
            <div id="logo">LOGO</div>
            <ul class="menu">
                <li class="item">Category<span></span>
                    <ul>
                        <li onclick="window.location.href = '../MainPage/MainPage.php'">Home</li>
                        <li onclick="window.location.href = '../Course/CoursePage.php'">Course</li>
                        <li onclick="window.location.href = '../Quiz/QuizList.php'">Quiz</li>
                    </ul>
                </li>
                <li class="item">About<span></span>
                    <ul>
                        <li onclick="window.location.href = '../Comment/Comment.php'">Comment</li>
                        <li onclick="window.location.href = '../ContactUs/ContactUs.php'">Contact Us</li>
                        <li onclick="window.location.href = '../AboutUS/AboutUs.html'">About Us</li>
                        <li onclick="window.location.href = '../Lecturer/AboutTheTutor.php'">Our Lecturer</li>
                    </ul>
                </li>
            </ul>
        </div>
        <script>
            const menuItems = document.querySelectorAll('.menu > li');

            //Loop through each menu item
            menuItems.forEach((menuItem) => {
                //Get the submenu
                const submenu = menuItem.querySelector('ul');

                //Set the max height of the submenu
                submenu.style.maxHeight = submenu.scrollHeight + 'px';

                //When the mouse enters the menu item, set the max height of the submenu
                menuItem.addEventListener('mouseenter', () => {
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                });

                //When the mouse leaves the menu item, set the max height of the submenu to 0
                menuItem.addEventListener('mouseleave', () => {
                    submenu.style.maxHeight = '0';
                });
            });
        </script>
        <div class="right-bar">
            <i class="iconfont icon-youxiang" onclick="window.location.href='../Mailbox/Mailbox.php'"></i>
            <i class="iconfont icon-31gouwuchexuanzhong"
                onclick="window.location.href='../ShoppingCart/ShoppingCart.php'"></i>
            <i class="iconfont icon-user" onclick="window.location.href='../UserProfile/UserProfile.php'"></i>
            <i class="iconfont icon-Logout" onclick="window.location.href='../Logout.php'"></i>
        </div>
    </header>

    <section>
        <div class="Ourmentors">
            <h1 class="heading">Our Mentors</h1>
            <p class="declaration">Our leadership team has one goal: to help learners quickly learn knowledge in
                different fields and develop their abilities.</p>
            <div class="tutorflex">
                <?php
                include "../ConnectDB.php";
                $sql = "SELECT * FROM lecturer";
                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    die("Invalid Query" . $conn->error);
                }

                while ($row = $result->fetch_assoc()) {
                    $imageFolder = '../Dashboard/Lecturer/';
                    $imagePath = $imageFolder . $row['LecturerImage'];

                    echo "<div class='tutorDiv'onclick=\"window.location.href='../LecturerDetail/LecturerDetail.php?LecturerID={$row['LecturerID']}'\">
                            <img src='$imagePath' alt='Lecturer'>
                            <h1>Lecturer Name: {$row['LecturerName']}</h1>
                            <h2>Teaching Subject: {$row['CourseName']}</h2>
                            <h2>Qualification: {$row['LecturerQualification']} Years</h2>
                        </div>";
                }
                ?>
            </div>
        </div>
        <div class="joinour">
            <P>Join Our team now</P>
            <button onclick="window.location.href = '../ContactUs/ContactUs.php'">
                Explore Jobs
            </button>
        </div>
    </section>
    <iframe src="../Footer.html" frameborder="0" width="100%" height="420px"></iframe>
</body>

</html>