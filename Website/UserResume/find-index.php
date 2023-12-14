<?php
//include the database connection file
include '../ConnectDB.php';
//include the session file
include '../Session.php';

//create a SQL query to select the resume information from the database
$sql = "SELECT * FROM userresume WHERE UserID = $userID";

//execute the query and store the result in the $result variable
$result = $conn->query($sql);

//if the query fails, print an error message
if ($result === false) {
    echo "Error: " . $conn->error;
    //if the query is successful, check if there is any resume information in the database
} else {
    if ($result->num_rows > 0) {
        //if there is resume information, fetch the resume information from the database
        $row = $result->fetch_assoc();
        $image = $row['UserImage'];
        $experience = $row['Experience'];
        $education = $row['Education'];
        $skillset = $row['Skill'];
        $language = $row['Language_'];
        //if there is no resume information, set the resume information to "None"
    } else {
        $experience = "None";
        $education = "None";
        $skillset = "None";
        $language = "None";
    }
}
//close the database connection
$conn->close();
?>