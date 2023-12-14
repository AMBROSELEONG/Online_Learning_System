<?php
//include the connection to the database
include '../ConnectDB.php';
//include the session
include '../Session.php';

//check if the user is logged in
if (isset($_SESSION['UserID'])) {
    //get the user id
    $userID = $_SESSION['UserID'];

    //query the database to get the user details
    $query = "SELECT UserName, Email, ContactNumber FROM users WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    //check if the user is logged in
    if ($result->num_rows > 0) {
        //get the user details
        $userDetails = $result->fetch_assoc();
       
        //get the user name
        $name = $userDetails['UserName'];
        //get the user email
        $email = $userDetails['Email'];
        //get the user phone number
        $phone = $userDetails['ContactNumber'];
    }
    //close the statement
    $stmt->close();
    //close the connection
    $conn->close();
}
?>