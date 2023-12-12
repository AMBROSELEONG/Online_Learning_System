<?php
    include 'find-user.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="ContactUs.css">
    <link rel="stylesheet" href="../icon/iconfont.css">
</head>

<body>
    <header>
        <div id="mySidepanel" class="sidepanel">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <form action="" id="search-bar-form">
                <input type="text" id="search-bar" placeholder="Search...">
                <button type="submit" id="search-bar-submit"><i class="iconfont icon-sousuo"></i></button>
            </form>
            <a href="../MainPage/MainPage.php"><i class="iconfont icon-book1">
                    <p>Home</p>
                </i></a>
            <a href="../Course/CoursePage.html"><i class="iconfont icon-book1">
                    <p>Course</p>
                </i></a>
            <a href="../Quiz/QuizList.html"><i class="iconfont icon-shijuan">
                    <p>Quiz</p>
                </i></a>
            <a href="../ShoppingCart/ShoppingCart.html"><i class="iconfont icon-31gouwuchexuanzhong">
                    <p>Shopping Cart</p>
                </i></a>
            <a href="../UserProfile/UserProfile.php"><i class="iconfont icon-user">
                    <p>User Info</p>
                </i></a>
            <a href="../AboutUS/AboutUs.html"><i class="iconfont icon-guanyuwomen">
                    <p>About Us</p>
                </i></a>
            <a href="../Lecturer/AboutTheTutor.html"><i class="iconfont icon-xuexiao">
                    <p>Tutor</p>
                </i></a>
            <a href="../Comment/Comment.php"><i class="iconfont icon-comment">
                    <p>Comment</p>
                </i></a>
        </div>

        <button class="openbtn" onclick="openNav()">☰</button>

        <script>
            function openNav() {
                document.getElementById("mySidepanel").style.width = "30rem";
            }

            function closeNav() {
                document.getElementById("mySidepanel").style.width = "0rem";
            }
        </script>
        <div class="left-bar">
            <div id="logo">LOGO</div>
            <ul class="menu">
                <li class="item">Category<span></span>
                    <ul>
                        <li onclick="window.location.href = '../MainPage/MainPage.php'">Home</li>
                        <li onclick="window.location.href = '../Course/CoursePage.html'">Course</li>
                        <li onclick="window.location.href = '../Quiz/QuizList.html'">Quiz</li>
                    </ul>
                </li>
                <li class="item">About<span></span>
                    <ul>
                        <li onclick="window.location.href = '../Comment/Comment.php'">Comment</li>
                        <li onclick="window.location.href = '../AboutUS/AboutUs.html'">About Us</li>
                        <li onclick="window.location.href = '../Lecturer/AboutTheTutor.html'">Our Lecturer</li>
                    </ul>
                </li>
            </ul>
        </div>
        <script>
            const menuItems = document.querySelectorAll('.menu > li');

            menuItems.forEach((menuItem) => {
                const submenu = menuItem.querySelector('ul');

                // 计算子菜单的最大高度
                submenu.style.maxHeight = submenu.scrollHeight + 'px';

                // 当鼠标悬停在菜单项上时，将 max-height 设置为计算值
                menuItem.addEventListener('mouseenter', () => {
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                });

                // 当鼠标离开时，将 max-height 重置为 0
                menuItem.addEventListener('mouseleave', () => {
                    submenu.style.maxHeight = '0';
                });
            });
        </script>
        <div class="right-bar">
            <form action="" id="search-bar-form">
                <input type="text" id="search-bar" placeholder="Search...">
                <button type="submit" id="search-bar-submit"><i class="iconfont icon-sousuo"></i></button>
            </form>
            <i class="iconfont icon-31gouwuchexuanzhong"
                onclick="window.location.href='../ShoppingCart/ShoppingCart.html'"></i>
            <i class="iconfont icon-user" onclick="window.location.href='../UserProfile/UserProfile.php'"></i>
        </div>
    </header>
    <section>
        <div class="container">

            <h3 class="heading">Contact us</h3>

            <div class="contactus">
                <div class="contactus-form">
                    <form action="insert.php" method="post">
                        <input type="hidden" name="UserID" id="UserID" value="<?php echo isset($userID) ? $userID : ''; ?>">
                        <p>Your name</p>
                        <input class="form-name" name="UserName" placeholder="Name..." id="UserName" value="<?php echo isset($name) ? $name : ''; ?>"required/><br>
                        <p>Your phone number</p>
                        <input class="form-phone" name="ContactNumber" placeholder="Phone..." id="ContactNumber" value="<?php echo isset($phone) ? $phone : ''; ?>"required/><br>
                        <p>Your email address</p>
                        <input class="form-email" name="Email" placeholder="E-mail..." id="Email" value="<?php echo isset($email) ? $email : ''; ?>" required/><br>
                        <p>Your message</p>
                        <textarea class="form-text" name="Message" placeholder="How can we help you?" id="Message" required></textarea><br>
                        <input type="hidden" name="replyStatus" value="Waiting Reply">
                        <input class="btn-send" type="submit" value="Send" /><br><br>
                    </form>
                </div>
                <div class="contactus-question">
                    <h1>Have a question for us?</h1>
                    <div class="questionDiv-flex">
                        <div class="questionDiv">
                            <h1><ins>Account & notifications</ins></h1>
                            <p>If you have trouble logging in or need to change your account settings (such as your
                                name, email address, or password)</p>
                        </div>
                        <div class="questionDiv">
                            <h1><ins>Privacy query</ins></h1>
                            <p>If you have questions about our privacy statement or have questions about how we protect
                                your personal information, you can contact us at <a href="">email</a></p>
                        </div>
                    </div>
                    <div class="questionDiv-flex">
                        <div class="questionDiv">
                            <h1><ins>Industry Partnership Inquiries</ins></h1>
                            <p>If you’re a university interested in creating Professional Certificates on our platform,
                                please contact us <a href="">here</a>.</p>
                        </div>
                        <div class="questionDiv">
                            <h1><ins>Refund policies</ins></h1>
                            <p>If you decide not to complete a course or specialization you paid for, we may be able to
                                refund your payment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="footer-container-left">
            <p onclick="window.location.href = '../AboutUS/AboutUs.html'">About US</p>
            <p onclick="window.location.href = '../ContactUs/ContactUs.html'">Contact US</p>
            <p>Term</p>
            <p>Privacy Policy</p>
            <p onclick="window.location.href = 'https://www.newera.edu.my/index.php'">New Era University College</p>
        </div>
        <div class="footer-container-center">
            <div>
                <i class="iconfont icon-instagram">
                    <p>Instagram</p>
                </i>
            </div>
            <div>
                <i class="iconfont icon-facebook_facebook">
                    <p>Facebook</p>
                </i>
            </div>
            <div>
                <i class="iconfont icon-whatsapp">
                    <p>Whatsapp</p>
                </i>
            </div>
            <div>
                <i class="iconfont icon-wechat">
                    <p>Wechat</p>
                </i>
            </div>
        </div>
        <div class="footer-container-right">
            <p onclick="window.location.href = '../Course/CoursePage.html'">Course</p>
            <p onclick="window.location.href = '../Quiz/QuizList.html'">Quiz</p>
            <p onclick="window.location.href = '../Lecturer/AboutTheTutor.html'">Lecturer</p>
            <p>Help And Support</p>
            <p>Copyright © 2021 New Era University College. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>