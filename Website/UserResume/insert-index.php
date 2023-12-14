<?php
//include the connection to the database
include '../ConnectDB.php';
//include the session class
include '../Session.php';

//prepare the statement to select the user image
$getUserImage = $conn->prepare("SELECT UserImage FROM userresume WHERE UserID = ?");
//bind the userID to the statement
$getUserImage->bind_param("i", $userID);
//execute the statement
$getUserImage->execute();
//store the result of the statement
$getUserImage->store_result();

//check if the statement returns a result
if ($getUserImage->num_rows > 0) {
    //bind the result to the userImage variable
    $getUserImage->bind_result($userImage);
    //fetch the result
    $getUserImage->fetch();

    //echo the user image
    echo '<img src="' . $userImage . '" alt="User Image" class="user-img">';
} else {
    //echo an error message if no result is found
    echo "No UserImage found for the given UserID.";
}

//check if the save button is pressed
if (isset($_POST['save'])) {
    //store the values of the form in variables
    $experience = isset($_POST['Experience']) ? $_POST['Experience'] : '';
    $education = isset($_POST['Education']) ? $_POST['Education'] : '';
    $skillset = isset($_POST['Skillset']) ? $_POST['Skillset'] : '';
    $language = isset($_POST['Language']) ? $_POST['Language'] : '';

    //check if all the values are not empty
    if ($experience != '' && $education != '' && $skillset != '' && $language != '') {
        //prepare the statement to check if the userID exists
        $checkUser = $conn->prepare("SELECT UserID FROM userresume WHERE UserID = ?");
        //bind the userID to the statement
        $checkUser->bind_param("i", $userID);
        //execute the statement
        $checkUser->execute();
        //store the result of the statement
        $checkUser->store_result();

        //check if the userID exists
        if ($checkUser->num_rows == 0) {
            //prepare the statement to insert the data
            $stmt = $conn->prepare("INSERT INTO userresume (UserID, Experience, Education, Skill, Language_) VALUES (?, ?, ?, ?, ?)");
            //bind the values to the statement
            $stmt->bind_param("issss", $userID, $experience, $education, $skillset, $language);
            //set the action to inserted
            $action = 'inserted';
        } else {
            //prepare the statement to update the data
            $stmt = $conn->prepare("UPDATE userresume SET Experience = ?, Education = ?, Skill = ?, Language_ = ? WHERE UserID = ?");
            //bind the values to the statement
            $stmt->bind_param("ssssi", $experience, $education, $skillset, $language, $userID);
            //set the action to updated
            $action = 'updated';
        }

        //execute the statement
        if ($stmt->execute()) {
            //echo a success message
            echo "<script>alert('Record $action successfully!'); window.location.href = 'UserResume.php';</script>";
        } else {
            //echo an error message
            echo "<script>alert('Record $stmt->error!'); window.location.href = 'UserResume.php';</script>";
        }
        //close the statement
        $stmt->close();
    } else {
        //echo an error message if no data is entered
        echo "<script>alert('No data to save!'); window.location.href = 'UserResume.php';</script>";
    }
} else {
    //echo an error message if the save button is not pressed
    echo "<script>alert('No data to save!'); window.location.href = 'UserResume.php';</script>";
}
//close the connection to the database
$conn->close();
?>
