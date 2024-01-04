<?php
include '../ConnectDB.php';

//Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    //Check if the ReplyID parameter is set
    if (!isset($_GET['ReplyID'])) {
        //Redirect to the Mailbox page
        header("location: Mailbox.php");
        exit;
    }
    //Store the ReplyID parameter
    $id = $_GET['ReplyID'];

    //Create a prepared statement to select the Title, ReplyMessage and ReplyDate from the email table where the ReplyID matches the parameter
    $checkUser = $conn->prepare("SELECT Title, ReplyMessage, ReplyDate FROM email WHERE ReplyID = ?");
    //Bind the parameter to the prepared statement
    $checkUser->bind_param("i", $id);
    //Execute the prepared statement
    $checkUser->execute();
    //Store the result of the prepared statement
    $checkUser->store_result();

    //Bind the result of the prepared statement to the variables
    $checkUser->bind_result($Title, $ReplyMessage, $ReplyDate);
    //Fetch the result of the prepared statement
    $checkUser->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/439c7cac30.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .email-card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .email-card .card-header {
            border-bottom: none;
            background-color: #007bff;
            border-radius: 10px 10px 0 0;
            color: white;
            padding: 15px;
        }

        .email-card .email-list-item {
            border-bottom: 1px solid #eee;
        }

        .email-card .email-list-item:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .email-card .email-list-item a {
            color: #333;
            text-decoration: none;
        }

        .email-card .email-list-item a:hover {
            text-decoration: none;
            color: #333;
        }

        .email-card .email-list-item .email-title {
            font-weight: bold;
        }

        .email-card .email-list-item .email-date {
            color: #999;
        }

        .email-card .email-list-item .email-content {
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <nav
                    class="navbar navbar-expand-md navbar-dark bg-primary flex-md-column flex-row align-items-start py-2">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav flex-md-column flex-row w-100 justify-content-between">
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="../MainPage/MainPage.php"
                                        target="_top">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="../Course/CoursePage.php"
                                        target="_top">Course</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="../Quiz/QuizList.php" target="_top">Quiz</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="../Lecturer/AboutTheTutor.php"
                                        target="_top">Lecturer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="../AboutUS/AboutUs.html" target="_top">About
                                        Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="../ContactUs/ContactUs.php"
                                        target="_top">Contact
                                        Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="../Comment/Comment.php"
                                        target="_top">Comment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="../ShoppingCart/ShoppingCart.php"
                                        target="_top"><i class="fas fa-shopping-cart"></i> Cart</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user"></i> User
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="../UserProfile/UserProfile.php"
                                            target="_top">User
                                            Profile</a>
                                        <a class="dropdown-item" href="../UserResume/UserResume.php" target="_top">User
                                            Resume</a>
                                        <a class="dropdown-item" href="../UserHistory/UserHistory.php"
                                            target="_top">User
                                            History</a>
                                        <a class="dropdown-item" href="../Mailbox/Mailbox.php" target="_top">Mail
                                            Box</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="../Logout.php">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-md-8">
                <div class="email-card">
                    <div class="card-header">
                        <h4 class="mb-0">Your Inbox</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action email-list-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 email-title">
                                        <?php echo $Title; ?>
                                    </h5>
                                    <small class="email-date">
                                        <?php echo $ReplyDate; ?>
                                    </small>
                                </div>
                                <p class="mb-1 email-content">
                                    <?php echo $ReplyMessage; ?>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>