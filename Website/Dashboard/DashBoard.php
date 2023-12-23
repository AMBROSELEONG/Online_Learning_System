<?php
session_start();

// Check if AdminID is set in the session
if (isset($_SESSION['AdminID'])) {
    // Get the AdminID from the session
    $adminID = $_SESSION['AdminID'];

    // Include your database connection
    include '../ConnectDB.php';

    // Create a prepared statement to select the UserName based on AdminID
    $stmt = $conn->prepare("SELECT UserName FROM admin WHERE AdminID = ?");
    $stmt->bind_param("i", $adminID); // Assuming AdminID is an integer, adjust the type accordingly

    // Execute the prepared statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a row is found
    if ($result->num_rows > 0) {
        // Fetch the UserName
        $row = $result->fetch_assoc();
        $userName = $row['UserName'];

        // Now $userName contains the UserName corresponding to the AdminID

        // Free the result set and close the prepared statement
        $stmt->free_result();
        $stmt->close();

        // Close the database connection
        $conn->close();

        // Use $userName as needed in your code
    }
} else {
    // If AdminID is not set in the session, redirect to login page
    header("location: Login/Login.php");
    exit();
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Dashboard.css">
    <link rel='stylesheet' href='icon2/iconfont.css'>
    <link rel="stylesheet" href="icon/iconfont.css">

</head>

<body>
    <div class='dashboard'>
        <div class="dashboard-nav">
            <header>
                <div style="padding: 20px;">
                    <h3 style="color: white">Welcome,
                        <?php echo $userName ?>
                    </h3>
                </div>
            </header>
            <nav class="dashboard-nav-list">
                <a href="Home.php" target="content" class="dashboard-nav-item menu-link">
                    <i class="iconfont icon-home icon"></i>Home
                </a>
                <a href="Course/Course.php" target="content" class="dashboard-nav-item menu-link">
                    <i class="iconfont icon-kecheng- icon"></i>Course
                </a>
                <a href="CourseType/CourseType.php" target="content" class="dashboard-nav-item menu-link">
                    <i class="iconfont icon-kecheng- icon"></i>CourseType
                </a>
                <a href="CourseDetail/CourseDetail.php" target="content" class="dashboard-nav-item menu-link">
                    <i class="iconfont icon-kecheng- icon"></i>CourseDetail
                </a>
                <a href="Quiz/Quiz.php" target="content" class="dashboard-nav-item menu-link">
                    <i class="iconfont icon-zuoye icon"></i> Quiz
                </a>
                <a href="QuizType/QuizType.php" target="content" class="dashboard-nav-item menu-link">
                    <i class="iconfont icon-zuoye icon"></i> QuizType
                </a>
                <a href="QuizQuestion/QuizQuestion.php" target="content" class="dashboard-nav-item menu-link">
                    <i class="iconfont icon-zuoye icon"></i> QuizQuestion
                </a>
                <a href="Lecturer/Lecturer.php" target="content" class="dashboard-nav-item menu-link">
                    <i class="iconfont icon-daoshi icon"></i> Lecturer
                </a>
                <a href="LecturerDetail/LecturerDetail.php" target="content" class="dashboard-nav-item menu-link">
                    <i class="iconfont icon-daoshi icon"></i> LecturerDetail
                </a>
                <a href="User/User.php" target="content" class="dashboard-nav-item menu-link">
                    <i class="iconfont icon-user-group icon"></i> User
                </a>
                <a href="Order.php" target="content" class="dashboard-nav-item menu-link">
                    <i class="iconfont icon-order_unread icon"></i> Order
                </a>
                <a href="Contact/Contact.php" target="content" class="dashboard-nav-item menu-link">
                    <i class="iconfont icon-contacts icon"></i> Contact
                </a>
                <a href="Comment/Comment.php" target="content" class="dashboard-nav-item menu-link">
                    <i class="iconfont icon-liuyan icon"></i> Comment
                </a>
                <div class="nav-item-divider"></div>
                <a href="Logout.php" class="dashboard-nav-item">
                    <i class="iconfont icon-Logout icon"></i> Logout
                </a>
            </nav>
        </div>
        <div class='dashboard-app'>
            <div class='dashboard-content'>
                <header class="cd__intro">
                    <h1><span style="cursor: pointer;" onclick="window.location.href='../MainPage/MainPage.php'">Online
                            Learning System</span> > Dashboard</h1>
                </header>
                <div class='container'>
                    <div class='card'>
                        <h1 style="text-align: center; margin: 10px;"></h1>
                        <title>Home</title>
                        <iframe name="content" src="Home.php" frameborder="0" width="100%" height="100%"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<script>
    window.onload = function () {
        // Get the iframe element by its name
        var iframe = document.getElementsByName('content')[0];
        // Set the onload event handler for the iframe
        iframe.onload = function () {
            // Get the title of the page in the iframe
            var pageTitle = iframe.contentDocument.title;
            // Get the h1 element with the class 'card'
            var helloTitle = document.querySelector('.card h1');
            // Set the inner text of the h1 element to the page title
            helloTitle.innerText = pageTitle;
        };
    };

</script>

</html>