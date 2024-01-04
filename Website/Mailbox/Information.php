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

        .vertical-nav {
            min-width: 17rem;
            width: 17rem;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.4s;
        }

        .page-content {
            width: calc(100% - 17rem);
            margin-left: 17rem;
            transition: all 0.4s;
        }

        /* for toggle behavior */

        #sidebar.active {
            margin-left: -17rem;
        }

        #content.active {
            width: 100%;
            margin: 0;
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -17rem;
            }

            #sidebar.active {
                margin-left: 0;
            }

            #content {
                width: 100%;
                margin: 0;
            }

            #content.active {
                margin-left: 17rem;
                width: calc(100% - 17rem);
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="vertical-nav bg-white" id="sidebar">
            <h4 class="text-gray font-weight-bold text-uppercase px-3 pb-4 mb-0 mt-5">Main</h4>
            <ul class="nav flex-column bg-white mb-0">
                <li class="nav-item">
                    <a href="../MainPage/MainPage.php" class="nav-link text-dark font-italic bg-light">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../Course/CoursePage.php" class="nav-link text-dark font-italic">
                        Course
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../Quiz/QuizList.php" class="nav-link text-dark font-italic">
                        Quiz
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../Lecturer/AboutTheTutor.php" class="nav-link text-dark font-italic">
                        Lecturer
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../AboutUS/AboutUs.html" class="nav-link text-dark font-italic">
                        About Us
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../ContactUs/ContactUs.php" class="nav-link text-dark font-italic">
                        Contact Us
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../Comment/Comment.php" class="nav-link text-dark font-italic">
                        Comment
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../ShoppingCart/ShoppingCart.php" class="nav-link text-dark font-italic">
                        Shopping Cart
                    </a>
                </li>
            </ul>
            <h4 class="text-gray font-weight-bold text-uppercase px-3  pb-4 mb-0 mt-5">User</h4>
            <ul class="nav flex-column bg-white mb-0">
                <li class="nav-item">
                    <a href="../UserProfile/UserProfile.php" class="nav-link text-dark font-italic">
                        User Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../UserResume/UserResume.php" class="nav-link text-dark font-italic">
                        User Resume
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../UserHistory/UserHistory.php" class="nav-link text-dark font-italic">
                        User History
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../Mailbox/Mailbox.php" class="nav-link text-dark font-italic">
                        MailBox
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../Logout.php" class="nav-link text-dark font-italic">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <script>
        $(function () {
            // Sidebar toggle behavior
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
            });
        });
    </script>
    <div class="page-content p-5" id="content">
        <!-- Toggle button -->
        <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i
                class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>