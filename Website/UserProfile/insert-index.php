<?php
include '../ConnectDB.php';
include '../Session.php';

// Check if the save button is pressed
if (isset($_POST['save'])) {
    // Get the values from the form
    $username = isset($_POST['Username']) ? $_POST['Username'] : '';
    $collegename = isset($_POST['CollegeName']) ? $_POST['CollegeName'] : '';
    $gmail = isset($_POST['Gmail']) ? $_POST['Gmail'] : '';
    $phone = isset($_POST['Phone']) ? $_POST['Phone'] : '';
    $about = isset($_POST['About']) ? $_POST['About'] : '';

    // Check if an image is uploaded
    if (!empty($_FILES['userImage']['name'])) {
        // Set the target directory for the image
        $targetDir = "../uploads/";
        // Set the target file name
        $targetFile = $targetDir . basename($_FILES["userImage"]["name"]);
        // Set the upload status to 1
        $uploadOk = 1;
        // Get the image file type
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an image
        $check = getimagesize($_FILES["userImage"]["tmp_name"]);

        // Create the target directory if it does not exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Check if the file is an image
        if ($check === false) {
            echo "File is not an image.";
            echo "<script>alert('File is not an image.'); window.location.href = 'UserProfile.php';</script>";
            $uploadOk = 0;
        }

        // Check if the file is an image of the correct type
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); window.location.href = 'UserProfile.php';</script>";
            $uploadOk = 0;
        }

        // Check if the file can be uploaded
        if ($uploadOk == 0) {
            echo "<script>alert('Sorry, your file was not uploaded.'); window.location.href = 'UserProfile.php';</script>";
        } else {
            // Upload the file
            if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($_FILES["userImage"]["name"]) . " has been uploaded.";
                // Set the image path
                $imagePath = $targetFile;
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href = 'UserProfile.php';</script>";
            }
        }
    } else {
        $imagePath = '';
    }

    // Check if the username, collegename, gmail, phone, about, and imagePath are empty
    if ($username != '' || $collegename != '' || $gmail != '' || $phone != '') {
        // Check if the userID exists in the userprofile table
        $checkUser = $conn->prepare("SELECT UserID FROM userprofile WHERE UserID = ?");
        $checkUser->bind_param("i", $userID);
        $checkUser->execute();
        $checkUser->store_result();

        if ($checkUser->num_rows > 0) {
            // Update the userprofile table
            $stmt = $conn->prepare("UPDATE userprofile SET UserName = ?, CollegeName = ?, Email = ?, Phone = ?, About = ?, UserImage = ? WHERE UserID = ?");
            $stmt->bind_param("ssssssi", $username, $collegename, $gmail, $phone, $about, $imagePath, $userID);
            $action = 'updated';

        } else {
            // Insert a new record into the userprofile table
            $stmt = $conn->prepare("INSERT INTO userprofile (UserID, UserName, CollegeName, Email, Phone, About, UserImage) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssss", $userID, $username, $collegename, $gmail, $phone, $about, $imagePath);
            $action = 'inserted';

            // Insert the imagePath into the userresume and userhistory tables
            $insertResumeImage = $conn->prepare("INSERT INTO userresume (UserID, UserImage) VALUES (?, ?)");
            $insertResumeImage->bind_param("is", $userID, $imagePath);
            $insertResumeImage->execute();

            $insertHistoryImage = $conn->prepare("INSERT INTO userhistory (UserID, UserImage) VALUES (?, ?)");
            $insertHistoryImage->bind_param("is", $userID, $imagePath);
            $insertHistoryImage->execute();
        }

        // Check if the userID exists in the userresume table
        $checkResume = $conn->prepare("SELECT UserID FROM userresume WHERE UserID = ?");
        $checkResume->bind_param("i", $userID);
        $checkResume->execute();
        $checkResume->store_result();

        if ($checkResume->num_rows > 0) {
            // Update the userresume table
            $updateResumeImage = $conn->prepare("UPDATE userresume SET UserImage = ? WHERE UserID = ?");
            $updateResumeImage->bind_param("si", $imagePath, $userID);
            $updateResumeImage->execute();

        } else {
            // Insert a new record into the userresume table
            $insertResumeImage = $conn->prepare("INSERT INTO userresume (UserID, UserImage) VALUES (?, ?)");
            $insertResumeImage->bind_param("is", $userID, $imagePath);
            $insertResumeImage->execute();
        }

        // Check if the userID exists in the userhistory table
        $checkHistory = $conn->prepare("SELECT UserID FROM userhistory WHERE UserID = ?");
        $checkHistory->bind_param("i", $userID);
        $checkHistory->execute();
        $checkHistory->store_result();

        if ($checkHistory->num_rows > 0) {
            // Update the userhistory table
            $updateHistoryImage = $conn->prepare("UPDATE userhistory SET UserImage = ? WHERE UserID = ?");
            $updateHistoryImage->bind_param("si", $imagePath, $userID);
            $updateHistoryImage->execute();

        } else {
            // Insert a new record into the userhistory table
            $insertHistoryImage = $conn->prepare("INSERT INTO userhistory (UserID, UserImage) VALUES (?, ?)");
            $insertHistoryImage->bind_param("is", $userID, $imagePath);
            $insertHistoryImage->execute();
        }


        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('Record $action successfully!'); window.location.href = 'UserProfile.php';</script>";
        } else {
            echo "<script>alert('Record $stmt->error!'); window.location.href = 'UserProfile.php';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('No data to save!'); window.location.href = 'UserProfile.php';</script>";
    }
}

$conn->close();
?>