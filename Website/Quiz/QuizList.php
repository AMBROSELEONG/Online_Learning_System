<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <link rel="stylesheet" type="text/css" href="QuizList.css">
    <link rel="stylesheet" href="../icon/iconfont.css">
    <link rel="stylesheet" href="../icon2/iconfont.css">
    <link rel="stylesheet" href="../Dashboard/icon2/iconfont.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="background-color: #f0f0f0;">
    <header class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href=""><img src="../Img/Logo_Icon.png" alt="" class="navbar-brand"
                    style="width: 10%"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../MainPage/MainPage.php">Home</a></li>
                            <li><a class="dropdown-item" href="../Course/CoursePage.php">Course</a></li>
                            <li><a class="dropdown-item" href="../Quiz/QuizList.php">Quiz</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            About
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../Comment/Comment.php">Comment</a></li>
                            <li><a class="dropdown-item" href="../ContactUs/ContactUs.php">Contact Us</a></li>
                            <li><a class="dropdown-item" href="../AboutUS/AboutUs.html">About Us</a></li>
                            <li><a class="dropdown-item" href="../Lecturer/AboutTheTutor.php">Our Lecturer</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form class="d-flex" method="post">
                            <input class="form-control me-2" id="searchInput" type="search" placeholder="Search Quiz"
                                aria-label="Search" name="search">
                            <button type="submit" id="search-bar-submit" name="submit"><i
                                    class="iconfont icon-sousuo"></i></button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Mailbox/Mailbox.php">
                            <i class="iconfont icon-youxiang" style="font-size: 30px"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../ShoppingCart/ShoppingCart.php">
                            <i class="iconfont icon-31gouwuchexuanzhong icon" style="font-size: 30px"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../UserProfile/UserProfile.php">
                            <i class="iconfont icon-user" style="font-size: 30px"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Logout.php">
                            <i class="iconfont icon-Logout" style="font-size: 30px"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <?php
    include "../ConnectDB.php";
    $sql = "SELECT * FROM quizcategory";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Invalid Query" . $conn->error);
    }
    ?>
    <div class="container-fluid mt-5 mb-5">
        <div class="row g-2">
            <div class="col-md-3">
                <div class="p-2 mt-5">
                    <div class="heading d-flex justify-content-between align-items-center">
                        <h6 class="text-uppercase">Categories</h6>
                        <span>--</span>
                    </div>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='form-check'>";
                        echo "<input class='form-check-input' type='checkbox' value='{$row['CategoryID']}' id='flexCheckCategory{$row['CategoryID']}'>";
                        echo "<label class='form-check-label' for='flexCheckCategory{$row['CategoryID']}'>{$row['CategoryName']}</label>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row g-2" id="productDisplay">
                    <?php

                    if (isset($_POST['search'])) {
                        $filterValue = $_POST['search'];
                        //create a query to search for the course based on the filter value
                        $query = "SELECT * FROM quiz WHERE QuizID LIKE '%$filterValue%' OR QuizName LIKE '%$filterValue%' OR CategoryName LIKE '%$filterValue%'";
                        //execute the query
                        $resultsearch = $conn->query($query);

                        //check if the query is valid
                        if (!$resultsearch) {
                            //if not, throw an error
                            die("Invalid query" . $conn->error);
                        }

                        if ($resultsearch->num_rows > 0) {
                            while ($row = $resultsearch->fetch_assoc()) {
                                $imageFolder = '../Dashboard/Quiz/';
                                $imagePath = $imageFolder . $row['QuizImage'];

                                echo "<div class='filterDiv category{$row['CategoryID']} col-md-4 product-card' onclick=\"window.location.href='../QuizDetail/Quiz.php?QuizID={$row['QuizID']}'\">";
                                echo "<div class='product py-4'>";
                                echo "<div class='text-center'>";
                                echo "<img src='$imagePath' width='200' alt='Course Image'>";
                                echo "</div>";
                                echo "<div class='about text-center'>";
                                echo "<h5>{$row['QuizName']}</h5>";
                                echo "<h6>{$row['CategoryName']}</h6>";
                                echo "</div>";
                                echo "<button class='btn btn-primary text-uppercase'>Start Quiz</button>";
                                echo "</div>";
                                echo "</div>";
                            }
                        } else {
                            echo "0 results";
                        }
                    } else {
                        $sqlcourse = "SELECT * FROM quiz";
                        $resultcourse = mysqli_query($conn, $sqlcourse);
                        if (!$resultcourse) {
                            die("Invalid Query" . $conn->error);
                        }

                        while ($row = $resultcourse->fetch_assoc()) {
                            $imageFolder = '../Dashboard/Quiz/';
                            $imagePath = $imageFolder . $row['QuizImage'];

                            echo "<div class='filterDiv category{$row['CategoryID']} col-md-4 product-card' onclick=\"window.location.href='../QuizDetail/Quiz.php?QuizID={$row['QuizID']}'\">";
                            echo "<div class='product py-4'>";
                            echo "<div class='text-center'>";
                            echo "<img src='$imagePath' width='200' alt='Course Image'>";
                            echo "</div>";
                            echo "<div class='about text-center'>";
                            echo "<h5>{$row['QuizName']}</h5>";
                            echo "<h6>{$row['CategoryName']}</h6>";
                            echo "</div>";
                            echo "<button class='btn btn-primary text-uppercase'>Start Quiz</button>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        function filterSelection() {
            // Get all checkboxes
            var checkboxes = document.querySelectorAll('.form-check-input');
            // Create array to store checked categories
            var checkedCategories = [];

            // Loop through checkboxes and add checked categories to array
            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    checkedCategories.push(checkbox.value);
                }
            });

            // Get all products
            var products = document.querySelectorAll('.filterDiv');

            // Loop through products and filter based on checked categories
            products.forEach(function (product) {
                // Get product categories
                var productCategories = product.classList;
                // Create boolean to track if product should be shown
                var showProduct = false;

                // If no categories are checked, show all products
                if (checkedCategories.length === 0) {
                    showProduct = true;
                } else {
                    // Loop through checked categories and check if product is in category
                    checkedCategories.forEach(function (category) {
                        if (productCategories.contains("category" + category)) {
                            showProduct = true;
                        }
                    });
                }

                // Show or hide product based on boolean
                if (showProduct) {
                    product.classList.remove("hide");
                    product.classList.add("show");
                } else {
                    product.classList.remove("show");
                    product.classList.add("hide");
                }
            });
        }

        // Add event listeners to checkboxes for filtering
        var checkboxes = document.querySelectorAll('.form-check-input');
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', filterSelection);
        });

        // Initial display of all products
        filterSelection();
    </script>

</body>

</html>