<?php
include 'find-user.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <link rel="stylesheet" href="../icon/iconfont.css">
    <link rel="stylesheet" href="../icon2/iconfont.css">
    <link rel="stylesheet" href="../Dashboard/icon2/iconfont.css">
    <link rel="stylesheet" href="ContactUs.css">
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
            <a href="../AboutUS/AboutUs.html"><i class="iconfont icon-guanyuwomen">
                    <p>About Us</p>
                </i></a>
            <a href="../Lecturer/AboutTheTutor.php"><i class="iconfont icon-xuexiao">
                    <p>Tutor</p>
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
        <div class="container">

            <h3 class="heading">Contact us</h3>

            <div class="contactus">
                <div class="contactus-form">
                    <form action="insert.php" method="post">
                        <input type="hidden" name="UserID" id="UserID"
                            value="<?php echo isset($userID) ? $userID : ''; ?>">
                        <p>Your name</p>
                        <input class="form-name" name="UserName" placeholder="Name..." id="UserName"
                            value="<?php echo isset($name) ? $name : ''; ?>" required /><br>
                        <p>Your phone number</p>
                        <input class="form-phone" name="ContactNumber" placeholder="Phone..." id="ContactNumber"
                            value="<?php echo isset($phone) ? $phone : ''; ?>" required /><br>
                        <p>Your email address</p>
                        <input class="form-email" name="Email" placeholder="E-mail..." id="Email"
                            value="<?php echo isset($email) ? $email : ''; ?>" required /><br>
                        <p>Your message</p>
                        <textarea class="form-text" name="Message" placeholder="How can we help you?" id="Message"
                            required></textarea><br>
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
    <iframe src="../Footer.html" frameborder="0" width="100%" height="420px"></iframe>
</body>

</html>