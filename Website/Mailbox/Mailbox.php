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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>