<?php
include '../Session.php';
?>

<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Learning System</title>
    <link rel="stylesheet" type="text/css" href="MainPage.css">
    <link rel="stylesheet" href="../icon/iconfont.css">
    <link rel="icon" type="image/x-icon" href="">
    <!-- 引入 Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- 引入 Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>

<body>
    <header>
        <div id="mySidepanel" class="sidepanel">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <form action="" id="search-bar-form">
                <input type="text" id="search-bar" placeholder="Search...">
                <button type="submit" id="search-bar-submit"><i class="iconfont icon-sousuo"></i></button>
            </form>
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
            <a href="../ContactUs/ContactUs.php"><i class="iconfont icon-dianhua">
                    <p>Contact Us</p>
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
                        <li onclick="window.location.href = '../Course/CoursePage.html'">Course</li>
                        <li onclick="window.location.href = '../Quiz/QuizList.html'">Quiz</li>
                    </ul>
                </li>
                <li class="item">About<span></span>
                    <ul>
                        <li onclick="window.location.href = '../Comment/Comment.php'">Comment</li>
                        <li onclick="window.location.href = '../ContactUs/ContactUs.php'">Contact Us</li>
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
        <div class="progress-container">
            <div class="progress-bar" id="myBar"></div>
        </div>
        <script>
            // When the user scrolls the page, execute myFunction 
            window.onscroll = function () { myFunction() };

            function myFunction() {
                var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                var scrolled = (winScroll / height) * 100;
                document.getElementById("myBar").style.width = scrolled + "%";
            }
        </script>
        <div class="swiper-container">
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="../img/Lecturer Img 0.png" alt="Picture 1">
                </div>
                <div class="swiper-slide">
                    <img src="../img/Lecturer Img 1.png" alt="Picture 2">
                </div>
                <div class="swiper-slide">
                    <img src="../img/Lecturer 2.png" alt="PIcture 3">
                </div>
                <div class="swiper-slide">
                    <img src="../img/lecturer 3.png" alt="Picture 4">
                </div>
            </div>
        </div>
        <script>
            var mySwiper = new Swiper('.swiper-container', {
                // 自动播放配置
                autoplay: {
                    delay: 3000, // 自动播放
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        </script>
        <div class="introduce-container">
            <p>Simple online learning system assignments from</p>
            <div style="display: flex;">
                <img src="../img/new-era-university-college.png" alt="New Era University College">
            </div>
        </div>
        <script>
            // 打开页面函数
            function openPage(pageName, elmnt, color) {
                // 获取所有tabcontent元素
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                // 遍历tabcontent，将其display属性设置为none
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                // 获取所有tablinks元素
                tablinks = document.getElementsByClassName("tablink");
                // 遍历tablinks，将其backgroundColor属性设置为空
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].style.backgroundColor = "";
                }
                // 获取指定pageName的元素，将其display属性设置为block
                document.getElementById(pageName).style.display = "block";
                // 获取指定elmnt的元素，将其backgroundColor属性设置为color
                elmnt.style.backgroundColor = color;
            }

            // 获取id为defaultOpen的元素，并点击它
            document.getElementById("defaultOpen").click();
        </script>
        <div class="aboutus-container">
            <p>We have everything you need to study online</p>
            <div class="aboutus-container-outside">
                <div class="aboutus-container-inner">
                    <img src="../img/high_quality.jpg" alt="High Quality">
                    <div class="content">
                        <p>High quality, carefully planned courses</p>
                    </div>
                </div>
                <div class="aboutus-container-inner">
                    <img src="../img/tutor.jpg" alt="Professional Lecturer">
                    <div class="content">
                        <p>Professional Lecturer</p>
                    </div>
                </div>
            </div>
            <div class="aboutus-container-outside">
                <div class="aboutus-container-inner">
                    <img src="../img/LiveWebinars.jpg" alt="Live Webinars">
                    <div class="content">
                        <p>Live Webinars and more</p>
                    </div>
                </div>
                <div class="aboutus-container-inner">
                    <img src="../img/Communities.jpg" alt="Communities">
                    <div class="content">
                        <p>Engage with communities</p>
                    </div>
                </div>
                <div class="aboutus-container-inner">
                    <img src="../img/Course.jpg" alt="Course">
                    <div class="content">
                        <p>Create a course that sells</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="tutorial-container">
            <div class="tutorial-container-inner-left">
                <img src="" alt="">
                <p>Tutorial-container</p>
                <ul>
                    <li>Test your professional talent!</li>
                    <li>Discover your creative talents!</li>
                    <li>Reveal your unique personality!</li>
                </ul>
                <button onclick="window.location.href = '../Course/CoursePage.html'">Go to buy course</button>
            </div>
            <div class="tutorial-container-inner-right">
                <video src="../img/MainPageVideo.mp4" controls style="width:100%; height:100%" autoplay muted loop>
            </div>
        </div>
    </section>
    <footer>
        <div class="footer-container-left">
            <p onclick="window.location.href = '../AboutUS/AboutUs.html'">About US</p>
            <p onclick="window.location.href = '../ContactUs/ContactUs.php'">Contact US</p>
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