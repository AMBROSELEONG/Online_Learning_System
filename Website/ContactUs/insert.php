<?php
include '../ConnectDB.php';

function verify($username, $contactnumber, $email, $message)
{
    $errors = array();

    // 检查用户输入的信息是否为空
    if (empty($username) || empty($message) || empty($email) || empty($contactnumber)) {
        $errors[] = "Please fill in all fields.";
    }

    // 检查输入的邮箱是否有效
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // 检查输入的电话号码是否有效
    if (!preg_match("/^(01[0-9])?\d{7,8}$/", $contactnumber)) {
        $errors[] = "Please enter a valid 10-digit phone number.";
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_POST['UserID'];
    $username = $_POST['UserName'];
    $contactnumber = $_POST['ContactNumber'];
    $email = $_POST['Email'];
    $message = $_POST['Message'];
    $replyStatus = $_POST['replyStatus'];

    $errors = verify($username, $contactnumber, $email, $message);

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