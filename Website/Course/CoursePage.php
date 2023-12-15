<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link rel="stylesheet" type="text/css" href="CorusePage.css">
    <link rel="stylesheet" href="../icon/iconfont.css">
    <link rel="stylesheet" href="../icon2/iconfont.css">
    <link rel="stylesheet" href="../Dashboard/icon2/iconfont.css">
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
                // Get the height of the document
                var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                // Calculate the percentage of the page scrolled
                var scrolled = (winScroll / height) * 100;
                // Set the width of the progress bar
                document.getElementById("myBar").style.width = scrolled + "%";
            }
        </script>
        <div id="myBtnContainer">
            <button class="btn active" onclick="filterSelection('all')"> Show all</button>
            <?php
            include "../ConnectDB.php";
            $sql = "SELECT * FROM coursecategory";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Invalid Query" . $conn->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "<button class='btn' onclick=\"filterSelection('{$row['CategoryID']}')\">" . $row['CategoryName'] . "</button>";
            }
            ?>
        </div>

        <div class="container">
            <?php
            $sqlcourse = "SELECT * FROM course";
            $resultcourse = mysqli_query($conn, $sqlcourse);
            if (!$resultcourse) {
                die("Invalid Query" . $conn->error);
            }

            while ($row = $resultcourse->fetch_assoc()) {
                // Path to the folder containing the images for courses
                $imageFolder = '../Dashboard/Course/';
                $imagePath = $imageFolder . $row['CourseImage']; // Assuming 'CourseImage' contains the image file name
            
                echo "<div class='filterDiv {$row['CategoryID']}' onclick=\"window.location.href='../CourseDetail/CourseDetail.php?CourseID={$row['CourseID']}'\">";
                echo "<img src='$imagePath' alt='Course'>";
                echo "<h1>{$row['CourseName']}</h1>";
                echo "<p class='price'>RM {$row['CoursePrice']}</p>";
                echo "<h2>{$row['CategoryName']}</h2>";
                echo "<button class='add-to-cart'>Add To Cart</button>";
                echo "</div>";
            }
            ?>

            <script>
                filterSelection("all")
                // Function to filter elements by class name
                function filterSelection(c) {
                    var x, i;
                    x = document.getElementsByClassName("filterDiv");
                    // If no filter is provided, hide all elements
                    if (c == "all") c = "";
                    // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
                    for (i = 0; i < x.length; i++) {
                        w3RemoveClass(x[i], "show");
                        if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
                    }
                }

                // Show filtered elements
                function w3AddClass(element, name) {
                    var i, arr1, arr2;
                    arr1 = element.className.split(" ");
                    arr2 = name.split(" ");
                    for (i = 0; i < arr2.length; i++) {
                        if (arr1.indexOf(arr2[i]) == -1) {
                            element.className += " " + arr2[i];
                        }
                    }
                }

                // Hide elements that are not selected
                function w3RemoveClass(element, name) {
                    var i, arr1, arr2;
                    arr1 = element.className.split(" ");
                    arr2 = name.split(" ");
                    for (i = 0; i < arr2.length; i++) {
                        while (arr1.indexOf(arr2[i]) > -1) {
                            arr1.splice(arr1.indexOf(arr2[i]), 1);
                        }
                    }
                    element.className = arr1.join(" ");
                }

                // Add active class to the current control button (highlight it)
                var btnContainer = document.getElementById("myBtnContainer");
                var btns = btnContainer.getElementsByClassName("btn");
                for (var i = 0; i < btns.length; i++) {
                    btns[i].addEventListener("click", function () {
                        var current = document.getElementsByClassName("active");
                        current[0].className = current[0].className.replace(" active", "");
                        this.className += " active";
                    });
                }
            </script>
    </section>
    <iframe src="../Footer.html" frameborder="0" width="100%" height="420px"></iframe>
</body>

</html>