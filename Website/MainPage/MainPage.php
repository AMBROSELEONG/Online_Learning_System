<?php
include "../Session.php"
    ?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Learning System</title>
    <link rel="stylesheet" type="text/css" href="MainPage.css">
    <link rel="stylesheet" href="../icon/iconfont.css">
    <link rel="stylesheet" href="../icon2/iconfont.css">
    <link rel="stylesheet" href="../Dashboard/icon2/iconfont.css">
    <link rel="icon" type="image/x-icon" href="">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

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
            <a href="../MainPage/MainPage.php"><i class="iconfont icon-book1">
                    <p>Home</p>
                </i></a>
            <a href="../Course/CoursePage.php"><i class="iconfont icon-book1">
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
                        <li onclick="window.location.href = '../Quiz/QuizList.html'">Quiz</li>
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
            <form action="" id="search-bar-form">
                <input type="text" id="search-bar" placeholder="Search...">
                <button type="submit" id="search-bar-submit"><i class="iconfont icon-sousuo"></i></button>
            </form>
            <i class="iconfont icon-youxiang" onclick="window.location.href='../Mailbox/Mailbox.php'"></i>
            <i class="iconfont icon-31gouwuchexuanzhong"
                onclick="window.location.href='../ShoppingCart/ShoppingCart.html'"></i>
            <i class="iconfont icon-user" onclick="window.location.href='../UserProfile/UserProfile.php'"></i>
            <i class="iconfont icon-Logout" onclick="window.location.href='../Logout.php'"></i>
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
                // Get the scroll position
                var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                // Get the height of the page
                var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                // Calculate the percentage of the page that is scrolled
                var scrolled = (winScroll / height) * 100;
                // Set the width of the progress bar to the percentage
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
                autoplay: {
                    delay: 3000,
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
            //Function to open a page when a tab is clicked
            function openPage(pageName, elmnt, color) {
                //Declare variables
                var i, tabcontent, tablinks;
                //Get all elements with class tabcontent and set their display to none
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                //Get all elements with class tablink and set their background color to empty string
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].style.backgroundColor = "";
                }
                //Set the display of the element with id pageName to block and set its background color to color
                document.getElementById(pageName).style.display = "block";
                elmnt.style.backgroundColor = color;
            }

            //Call the function when the default tab is clicked
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
                <button onclick="window.location.href = '../Course/CoursePage.php'">Go to buy course</button>
            </div>
            <div class="tutorial-container-inner-right">
                <video src="../img/MainPageVideo.mp4" controls style="width:100%; height:100%" autoplay muted loop>
            </div>
        </div>
    </section>
    <iframe src="../Footer.html" frameborder="0" width="100%" height="420px"></iframe>
</body>

</html>