<?php
//include the Session and ConnectDB files
include '../Session.php';
include '../ConnectDB.php';
//prepare a query to select the number of emails from the email table where the user ID matches the user ID passed in
$EmailQuery = $conn->prepare("SELECT COUNT(*) AS ReplyID FROM email WHERE UserID = ?");
//bind the user ID to the query
$EmailQuery->bind_param("i", $userID);
//execute the query
$EmailQuery->execute();

//get the result of the query
$result = $EmailQuery->get_result();

//check if the result is not empty
if ($result->num_rows > 0) {
    //fetch the result of the query
    $row = $result->fetch_assoc();
    //store the result in a variable
    $EmailCount = $row['ReplyID'];
}

//close the query
$EmailQuery->close(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mail Box</title>
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
            background: #edf1f5;
            margin-top: 20px;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid transparent;
            border-radius: 0;
        }

        .mailbox-widget .custom-tab .nav-item .nav-link {
            border: 0;
            color: #fff;
            border-bottom: 3px solid transparent;
        }

        .mailbox-widget .custom-tab .nav-item .nav-link.active {
            background: 0 0;
            color: #fff;
            border-bottom: 3px solid #2cd07e;
        }

        .no-wrap td,
        .no-wrap th {
            white-space: nowrap;
        }

        .table td,
        .table th {
            padding: .9375rem .4rem;
            vertical-align: top;
            border-top: 1px solid rgba(120, 130, 140, .13);
        }

        .font-light {
            font-weight: 300;
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
        <div class="card">
            <div class="card-body bg-primary text-white mailbox-widget pb-0">
                <h2 class="text-white pb-3">Your Mailbox</h2>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="inbox" aria-labelledby="inbox-tab" role="tabpanel">
                    <div>
                        <div class="row p-4 no-gutters align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <h3 class="font-light mb-0"><i class="ti-email mr-2"></i>
                                    <?php echo $EmailCount ?> Emails
                                </h3>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table email-table no-wrap table-hover v-middle mb-0 font-14">
                                <tbody>
                                    <?php
                                    //include the connection to the database
                                    include '../ConnectDB.php';

                                    //prepare the statement to select the data from the database
                                    $checkUser = $conn->prepare("SELECT ReplyID, UserID, Title, ReplyDate FROM email WHERE UserID = ?");
                                    //bind the userID to the statement
                                    $checkUser->bind_param("i", $userID);
                                    //execute the statement
                                    $checkUser->execute();
                                    //store the result of the statement
                                    $checkUser->store_result();

                                    //check if the statement executed successfully
                                    if (!$checkUser) {
                                        //if not, print an error message
                                        die("None Message" . $conn->error);
                                    }
                                    //bind the result of the statement to the variables
                                    $checkUser->bind_result($ReplyID, $UserID, $Title, $ReplyDate);

                                    //while loop to loop through the result of the statement
                                    while ($checkUser->fetch()) {
                                        //print the result of the statement in a table row
                                        echo "<tr onclick='redirectToInfoPage($ReplyID)'>
                                                        <td class='pl-3'>
                                                            <div class='custom-control custom-checkbox'>
                                                                <label class='custom-control-label' for='cst1'>&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class='mb-0 text-muted'>Online Learning System</span>
                                                        </td>
                                                        <td>
                                                            <a class='link' href='javascript: void(0)'>
                                                                <span class='text-dark'>$Title</span>
                                                            </a>
                                                        </td>
                                                        <td class='text-muted'>$ReplyDate</td>
                                                    </tr>";
                                    }
                                    ?>
                                    <script>
                                        //function to redirect to the information page
                                        function redirectToInfoPage(replyID) {
                                            //redirect to the information page with the given replyID
                                            window.location.href = 'Information.php?ReplyID=' + replyID;
                                        }
                                    </script>
                                </tbody>
                            </table>
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