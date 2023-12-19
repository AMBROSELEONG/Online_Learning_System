<?php
include '../ConnectDB.php';
include '../Session.php';

$sql = "SELECT * FROM userprofile WHERE UserID = $userID";
$result = $conn->query($sql);

if ($result === false) {
    echo "Error: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image = $row['UserImage'];
        $username = $row['UserName'];
        $collegename = $row['CollegeName'];
        $gmail = $row['Email'];
        $phone = $row['Phone'];
        $about = $row['About'];
    } else {
        $sql1 = "SELECT * FROM users WHERE UserID = $userID";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            $username = $row1['UserName'];
            $collegename = "None";
            $gmail = $row1['Email'];
            $phone = $row1['ContactNumber'];
            $about = "None";
        }
    }
}

$conn->close();
?>