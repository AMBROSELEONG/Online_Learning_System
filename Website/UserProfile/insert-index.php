<?php
// 包含数据库连接文件
include '../ConnectDB.php';
// 包含会话文件
include '../Session.php';

// 检查是否点击了保存按钮
if (isset($_POST['save'])) {
    // 从表单获取数据
    $username = isset($_POST['Username']) ? $_POST['Username'] : '';
    $collegename = isset($_POST['CollegeName']) ? $_POST['CollegeName'] : '';
    $gmail = isset($_POST['Gmail']) ? $_POST['Gmail'] : '';
    $phone = isset($_POST['Phone']) ? $_POST['Phone'] : '';
    $about = isset($_POST['About']) ? $_POST['About'] : '';

    // 检查是否上传了图片
    if (!empty($_FILES['userImage']['name'])) {
        // 设置图片目录
        $targetDir = "../uploads/";
        // 设置目标文件名
        $targetFile = $targetDir . basename($_FILES["userImage"]["name"]);
        // 上传状态
        $uploadOk = 1;
        // 获取图片文件类型
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // 检查图片大小
        $check = getimagesize($_FILES["userImage"]["tmp_name"]);

        // 检查目录是否存在
        if (!file_exists($targetDir)) {
            // 如果目录不存在，则创建目录
            mkdir($targetDir, 0777, true);
        }

        // 检查是否为图片
        if ($check === false) {
            // 如果不是图片，则显示错误消息
            echo "File is not an image.";
            echo "<script>alert('File is not an image.'); window.location.href = 'UserProfile.php';</script>";
            $uploadOk = 0;
        }

        // 检查图片类型是否允许
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            // 如果图片类型不允许，则显示错误消息
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); window.location.href = 'UserProfile.php';</script>";
            $uploadOk = 0;
        }

        // 检查文件是否已上传
        if ($uploadOk == 0) {
            // 如果文件未上传，则显示错误消息
            echo "<script>alert('Sorry, your file was not uploaded.'); window.location.href = 'UserProfile.php';</script>";
        } else {
            // 移动文件到目标目录
            if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $targetFile)) {
                // 如果文件上传成功，则显示成功消息
                echo "The file " . basename($_FILES["userImage"]["name"]) . " has been uploaded.";
                $imagePath = $targetFile;
            } else {
                // 如果文件未上传成功，则显示错误消息
                echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href = 'UserProfile.php';</script>";
            }
        }
    } else {
        // 如果未上传图片，则显示错误消息
        echo "<script>alert('No image uploaded.'); window.location.href = 'UserProfile.php';</script>";

        $imagePath = ''; // 如果未上传图片，则设置图片路径的默认值
    }

    // 根据 UserID 的存在性插入或更新数据
    if ($username != '' || $collegename != '' || $gmail != '' || $phone != '') {
        // 检查用户是否存在
        $checkUser = $conn->prepare("SELECT UserID FROM userprofile WHERE UserID = ?");
        $checkUser->bind_param("i", $userID);
        $checkUser->execute();
        $checkUser->store_result();

        // 检查用户是否存在
       if ($checkUser->num_rows > 0) {
            // 如果用户存在，则更新数据
            $stmt = $conn->prepare("UPDATE userprofile SET UserName = ?, CollegeName = ?, Email = ?, Phone = ?, About = ?, UserImage = ? WHERE UserID = ?");
            $stmt->bind_param("ssssssi", $username, $collegename, $gmail, $phone, $about, $imagePath, $userID);
            $action = 'updated';

        } else {
            // 如果用户不存在，则插入数据
            $stmt = $conn->prepare("INSERT INTO userprofile (UserID, UserName, CollegeName, Email, Phone, About, UserImage) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssss", $userID, $username, $collegename, $gmail, $phone, $about, $imagePath);
            $action = 'inserted';

            // 插入简历图片
            $insertResumeImage = $conn->prepare("INSERT INTO userresume (UserID, UserImage) VALUES (?, ?)");
            $insertResumeImage->bind_param("is", $userID, $imagePath);
            $insertResumeImage->execute();

            // 插入历史图片
            $insertHistoryImage = $conn->prepare("INSERT INTO userhistory (UserID, UserImage) VALUES (?, ?)");
            $insertHistoryImage->bind_param("is", $userID, $imagePath);
            $insertHistoryImage->execute();
        }

        // 检查简历图片是否存在
        $checkResume = $conn->prepare("SELECT UserID FROM userresume WHERE UserID = ?");
        $checkResume->bind_param("i", $userID);
        $checkResume->execute();
        $checkResume->store_result();

        if ($checkResume->num_rows > 0) {
            // 如果简历图片存在，则更新简历图片
            $updateResumeImage = $conn->prepare("UPDATE userresume SET UserImage = ? WHERE UserID = ?");
            $updateResumeImage->bind_param("si", $imagePath, $userID);
            $updateResumeImage->execute();

        } else {
            // 如果简历图片不存在，则插入简历图片
            $insertResumeImage = $conn->prepare("INSERT INTO userresume (UserID, UserImage) VALUES (?, ?)");
            $insertResumeImage->bind_param("is", $userID, $imagePath);
            $insertResumeImage->execute();
        }

        // 检查历史图片是否存在
        $checkHistory = $conn->prepare("SELECT UserID FROM userhistory WHERE UserID = ?");
        $checkHistory->bind_param("i", $userID);
        $checkHistory->execute();
        $checkHistory->store_result();

        if ($checkHistory->num_rows > 0) {
            // 如果历史图片存在，则更新历史图片
            $updateHistoryImage = $conn->prepare("UPDATE userhistory SET UserImage = ? WHERE UserID = ?");
            $updateHistoryImage->bind_param("si", $imagePath, $userID);
            $updateHistoryImage->execute();

        } else {
            // 如果历史图片不存在，则插入历史图片
            $insertHistoryImage = $conn->prepare("INSERT INTO userhistory (UserID, UserImage) VALUES (?, ?)");
            $insertHistoryImage->bind_param("is", $userID, $imagePath);
            $insertHistoryImage->execute();
        }


        // 执行语句
        if ($stmt->execute()) {
            // 如果执行成功，则显示成功消息
            echo "<script>alert('Record $action successfully!'); window.location.href = 'UserProfile.php';</script>";
        } else {
            // 如果执行失败，则显示错误消息
            echo "<script>alert('Record $stmt->error!'); window.location.href = 'UserProfile.php';</script>";
        }
        // 关闭语句
        $stmt->close();
    } else {
        // 如果没有要保存的数据，则显示错误消息
        echo "<script>alert('No data to save!'); window.location.href = 'UserProfile.php';</script>";
    }
}

// 关闭连接
$conn->close();
?>