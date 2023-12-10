<?php
// 包含数据库连接文件
include '../ConnectDB.php';
// 包含会话文件
include '../Session.php';

// 从数据库中获取用户图片
$getUserImage = $conn->prepare("SELECT UserImage FROM resumeprofile WHERE UserID = ?");
$getUserImage->bind_param("i", $userID);
$getUserImage->execute();
$getUserImage->store_result();

if ($getUserImage->num_rows > 0) {
    // 找到与 UserID 关联的 UserImage 数据
    $getUserImage->bind_result($userImage);
    $getUserImage->fetch();

    // 在这里使用 $userImage 变量来展示用户图片
    echo '<img src="' . $userImage . '" alt="User Image" class="user-img">';
} else {
    echo "No UserImage found for the given UserID.";
}

if (isset($_POST['save'])) {
    // 从表单获取数据
    $experience = isset($_POST['Experience']) ? $_POST['Experience'] : '';
    $education = isset($_POST['Education']) ? $_POST['Education'] : '';
    $skillset = isset($_POST['Skillset']) ? $_POST['Skillset'] : '';
    $language = isset($_POST['Language']) ? $_POST['Language'] : '';

    if ($experience != '' && $education != '' && $skillset != '' && $language != '') {
        // 检查用户是否存在
        $checkUser = $conn->prepare("SELECT UserID FROM resumeprofile WHERE UserID = ?");
        $checkUser->bind_param("i", $userID);
        $checkUser->execute();
        $checkUser->store_result();

        if ($checkUser->num_rows == 0) {
            // 如果用户存在，则插入用户数据
            $stmt = $conn->prepare("INSERT INTO resumeprofile (UserID, Experience, Education, Professional_Skill, Language_) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $userID, $experience, $education, $skillset, $language);
            $action = 'inserted';
        } else {
            // 如果用户不存在，则更新用户数据
            $stmt = $conn->prepare("UPDATE resumeprofile SET Experience = ?, Education = ?, Professional_Skill = ?, Language_ = ? WHERE UserID = ?");
            $stmt->bind_param("ssssi", $experience, $education, $skillset, $language, $userID);
            $action = 'updated';
        }

        if ($stmt->execute()) {
            // 如果执行成功，则显示成功消息
            echo "<script>alert('Record $action successfully!'); window.location.href = 'UserResume.php';</script>";
        } else {
            // 如果执行失败，则显示错误消息
            echo "<script>alert('Record $stmt->error!'); window.location.href = 'UserResume.php';</script>";
        }
        // 关闭语句
        $stmt->close();
    } else {
        // 如果没有要保存的数据，则显示错误消息
        echo "<script>alert('No data to save!'); window.location.href = 'UserResume.php';</script>";
    }
}

// 关闭连接
$conn->close();
?>