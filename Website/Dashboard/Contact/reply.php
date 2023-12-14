<?php
//include the ConnectDB.php file to connect to the database
include '../../ConnectDB.php';

//set the variables to empty strings
$ContactID = $_GET['ContactID'] ?? '';
$UserID = '';
$UserName = '';
$UserPhone = '';
$UserEmail = '';
$Message = '';
$Title = '';
$replyMessage = '';
$error = '';
$success = '';

//if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //if the ContactID is not empty
    if (!empty($ContactID)) {
        //query the database for the contact information
        $sql = "SELECT * FROM Contact WHERE ContactID = '$ContactID'";
        $result = $conn->query($sql);


        //if the query returns a result
        if ($result && $result->num_rows > 0) {
            //fetch the result
            $row = $result->fetch_assoc();
            //set the variables to the values from the database
            $UserID = $row['UserID'] ?? '';
            $UserName = $row['UserName'] ?? '';
            $UserPhone = $row['ContactNumber'] ?? '';
            $UserEmail = $row['Email'] ?? '';
            $Message = $row['Message'] ?? '';
        } else {
            //if the query returns no result, redirect to the Contact.php page
            header("location: Contact.php");
            exit;
        }
    } else {
        //if the ContactID is empty, redirect to the Contact.php page
        header("location: Contact.php");
        exit;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //if the request method is POST
    if (!empty($_POST['ContactID']) && !empty($_POST['UserID']) && !empty($_POST['UserName']) && !empty($_POST['ContactNumber']) && !empty($_POST['Email']) && !empty($_POST['Message']) && !empty($_POST['replyMessage'])) {
        //set the variables to the values from the POST request
        $ContactID = $_POST['ContactID'];
        $UserID = $_POST['UserID'];
        $UserName = $_POST['UserName'];
        $UserPhone = $_POST['ContactNumber'];
        $UserEmail = $_POST['Email'];
        $Title = $_POST['Title'];
        $Message = $_POST['Message'];
        $replyMessage = $_POST['replyMessage'];
        //set the post time to the current time
        $post_time = date('Y-m-d H:i:s');

        //insert the reply into the email table
        $insertReplyQuery = "INSERT INTO email (UserID, UserName, ContactNumber, Email, Title, Message, ReplyMessage, ReplyDate) VALUES ('$UserID', '$UserName', '$UserPhone', '$UserEmail', '$Title','$Message', '$replyMessage','$post_time')";
        $insertReplyResult = $conn->query($insertReplyQuery);

        //if the insertion is successful
        if ($insertReplyResult) {
            //update the Contact table to show the reply has been sent
            $updateContactQuery = "UPDATE Contact SET ReplyStatus = 'Replied' WHERE ContactID = '$ContactID'";
            $updateContactResult = $conn->query($updateContactQuery);

            //if the update is successful
            if ($updateContactResult) {
                //set the success message and redirect to the Contact.php page
                $success = "Reply sent successfully";
                echo "<script>alert('$success'); window.location.href = 'Contact.php';</script>";
                exit;
            } else {
                //if the update fails, set the error message
                $error = "Failed to update Contact table";
            }
        } else {
            //if the insertion fails, set the error message
            $error = "Failed to insert into reply table";
        }
    } else {
        //if the POST request is empty, set the error message
        $error = "Please fill in all fields";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2>Reply Contact</h2>
        <form method="post">
            <input type="hidden" name="ContactID" value="<?php echo $ContactID ?>">
            <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">User Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="UserName" value="<?php echo $UserName; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">User Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ContactNumber" value="<?php echo $UserPhone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">User Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Email" value="<?php echo $UserEmail; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Message</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Message" value="<?php echo $Message; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Title" placeholder="Your reply title">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Reply</label>
                <div class="col-sm-6">
                    <textarea name="replyMessage" placeholder="Your reply message" class="form-control"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Reply</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="Contact.php" role="button">Cancel</a>
                </div>
            </div>
            <?php
            // Check if there is an error message
            if (!empty($error)) {
                // Display an error message
                echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$error</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            ?>
            <?php
            // Check if there is a success message
            if (!empty($success)) {
                // Display a success message
                echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$success</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            ?>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>