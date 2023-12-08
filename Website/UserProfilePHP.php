<?php
include 'Session.php';
include 'ConnectDB.php';

if (isset($_POST['save'])) {
    $username = isset($_POST['Username']) ? $_POST['Username'] : '';
    $collegename = isset($_POST['CollegeName']) ? $_POST['CollegeName'] : '';
    $gmail = isset($_POST['Gmail']) ? $_POST['Gmail'] : '';
    $phone = isset($_POST['Phone']) ? $_POST['Phone'] : '';
    $about = isset($_POST['About']) ? $_POST['About'] : '';

    // Check if an image is uploaded
    if (!empty($_FILES['userImage']['name'])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["userImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["userImage"]["tmp_name"]);

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($_FILES["userImage"]["name"]) . " has been uploaded.";
                $imagePath = $targetFile;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No image uploaded.";
        $imagePath = ''; // Set a default value for image path if no image is uploaded
    }

    // Insert or update data based on the existence of UserID
    if ($username != '' || $collegename != '' || $gmail != '' || $phone != '') {
        $checkUser = $conn->prepare("SELECT UserID FROM userprofile WHERE UserID = ?");
        $checkUser->bind_param("i", $userID);
        $checkUser->execute();
        $checkUser->store_result();

        if ($checkUser->num_rows > 0) {
            $stmt = $conn->prepare("UPDATE userprofile SET UserName = ?, CollegeName = ?, Gmail = ?, Phone = ?, About = ?, UserImage = ? WHERE UserID = ?");
            $stmt->bind_param("ssssssi", $username, $collegename, $gmail, $phone, $about, $imagePath, $userID);
            $action = 'updated';
        } else {
            $stmt = $conn->prepare("INSERT INTO userprofile (UserID, UserName, CollegeName, Gmail, Phone, About, UserImage) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssss", $userID, $username, $collegename, $gmail, $phone, $about, $imagePath);
            $action = 'inserted';
        }

        if ($stmt->execute()) {
            echo "<script>alert('Record $action successfully!'); window.location.href = 'UserProfilePage.php';</script>";
        } else {
            echo "<script>alert('Record $stmt->error!'); window.location.href = 'UserProfilePage.php';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('No data to save!');</script>";
    }
}

$conn->close();
?>