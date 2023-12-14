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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
    <div class="container mt-5">
        <div class="row justify-content-center">
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