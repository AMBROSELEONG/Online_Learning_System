<?php
//include the database connection file
include '../ConnectDB.php';
//include the session file
include '../Session.php';
$image = $experience = $education = $skillset = $language = $username = $collegename = "None";
//create a SQL query to select the resume information from the database
$resumeSql = "SELECT * FROM userresume WHERE UserID = $userID";
// Query to fetch profile information
$profileSql = "SELECT * FROM userprofile WHERE UserID = $userID";
// Execute the query for resume information
$resumeResult = $conn->query($resumeSql);
// Execute the query for profile information
$profileResult = $conn->query($profileSql);

if ($resumeResult && $resumeResult->num_rows > 0) {
    $row = $resumeResult->fetch_assoc();
    $image = $row['UserImage'];
    $experience = $row['Experience'];
    $education = $row['Education'];
    $skillset = $row['Skill'];
    $language = $row['Language_'];
} 

if ($profileResult && $profileResult->num_rows > 0) {
    // Checking profile results and fetching profile information
    $row = $profileResult->fetch_assoc();
    $username = $row['UserName'];
    $collegename = $row['CollegeName'];
}
//close the database connection
$conn->close();
?>