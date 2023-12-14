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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
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

    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
                                                                <input type='checkbox' class='custom-control-input' id='cst1' />
                                                                <label class='custom-control-label' for='cst1'>&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class='mb-0 text-muted'>Online Learning System</span>
                                                        </td>
                                                        <td>
                                                            <a class='link' href='javascript: void(0)'>
                                                                <span class='badge badge-pill text-white font-medium badge-danger mr-2'>Work</span>
                                                                <span class='text-dark'>$Title</span>
                                                            </a>
                                                        </td>
                                                        <td><i class='fa fa-paperclip text-muted'></i></td>
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