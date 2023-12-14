<?php
include '../ConnectDB.php';

//This function checks if the username, message, email, and contact number are filled out. If not, it adds an error to the array. It also checks if the email is valid, and if the contact number is a valid 10-digit phone number.
function verify($username, $contactnumber, $email, $message)
{
    $errors = array();

    //Check if username, message, email, and contact number are filled out
    if (empty($username) || empty($message) || empty($email) || empty($contactnumber)) {
        $errors[] = "Please fill in all fields.";
    }

    //Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    //Check if contact number is a valid 10-digit phone number
    if (!preg_match("/^(01[0-9])?\d{7,8}$/", $contactnumber)) {
        $errors[] = "Please enter a valid 10-digit phone number.";
    }

    return $errors;
}

//This checks if the request method is a POST request. If it is, it stores the data from the POST request in variables. It then calls the verify function to check if the data is valid. If it is, it inserts the data into the database. If not, it prints an error message.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_POST['UserID'];
    $username = $_POST['UserName'];
    $contactnumber = $_POST['ContactNumber'];
    $email = $_POST['Email'];
    $message = $_POST['Message'];
    $replyStatus = $_POST['replyStatus'];

    $errors = verify($username, $contactnumber, $email, $message);

    //Insert data into database
    $insert = "INSERT INTO contact (UserID, UserName, ContactNumber, Email, Message, ReplyStatus) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("isssss", $userID, $username, $contactnumber, $email, $message, $replyStatus);

    if ($stmt->execute()) {
        echo "<script>alert('Your Message Send Successfully!'); window.location.href = 'ContactUs.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>