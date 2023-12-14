<?php
//include the database connection file
include '../ConnectDB.php';
//include the session file
include '../Session.php';

//create a SQL query to select the user profile information from the database
$sql = "SELECT * FROM userprofile WHERE UserID = $userID";

//execute the query and store the result in the $result variable
$result = $conn->query($sql);

//if the query fails, print an error message
if ($result === false) {
    echo "Error: " . $conn->error;
//if the query succeeds, check if there is a result
} else {
    if ($result->num_rows > 0) {

        //store the result in the $row variable
        $row = $result->fetch_assoc();
        //store the image, username, collegename, gmail, phone, and about variables
        $image = $row['UserImage'];
        $username = $row['UserName'];
        $collegename = $row['CollegeName'];
        $gmail = $row['Email'];
        $phone = $row['Phone'];
        $about = $row['About'];
    //if there is no result, set the username, collegename, gmail, phone, and about variables to "None"
    } else {
        $username = "None";
        $collegename = "None";
        $gmail = "None";
        $phone = "None";
        $about = "None";
    }
}

//close the database connection
$conn->close();
?>