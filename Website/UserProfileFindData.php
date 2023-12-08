<?php
session_start();

if (isset($_SESSION['UserID'])) {
    $userID = $_SESSION['UserID'];
} else {
    header("location: LoginForm.php");
    exit();
}
    
include 'ConnectDB.php';

$sql = "SELECT * FROM userprofile WHERE UserID = $userID"; // Assuming UserID is an integer

$result = $conn->query($sql);

if ($result === false) {
    echo "Error: " . $conn->error;
} else {
    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $image = $row['UserImage'];
        $username = $row['UserName'];
        $collegename = $row['CollegeName'];
        $gmail = $row['Gmail'];
        $phone = $row['Phone'];
        $about = $row['About'];
    } else {
        $username = "None";
        $collegename = "None";
        $gmail = "None";
        $phone = "None";
        $about = "None";
    }
}

$conn->close();
?>