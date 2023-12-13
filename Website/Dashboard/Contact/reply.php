<?php
include '../../ConnectDB.php';

// 获取URL中的参数
$ContactID = $_GET['ContactID'] ?? '';
$UserID = '';
$UserName = '';
$UserPhone = '';
$UserEmail = '';
$Message = '';
$Title = '';
$replyMessage = '';
$error = '';
$success = '';

// 判断请求方法
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // 检查ContactID是否为空
    if (!empty($ContactID)) {
        // 查询Contact表中的数据
        $sql = "SELECT * FROM Contact WHERE ContactID = '$ContactID'";
        $result = $conn->query($sql);


        // 如果查询到数据，则将查询到的数据赋值给对应的变量
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $UserID = $row['UserID'] ?? '';
            $UserName = $row['UserName'] ?? '';
            $UserPhone = $row['ContactNumber'] ?? '';
            $UserEmail = $row['Email'] ?? '';
            $Message = $row['Message'] ?? '';
        } else {
            // 如果没有查询到数据，则跳转到Contact.php页面
            header("location: Contact.php");
            exit;
        }
    } else {
        // 如果ContactID为空，则跳转到Contact.php页面
        header("location: Contact.php");
        exit;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取表单中的数据
    if (!empty($_POST['ContactID']) && !empty($_POST['UserID']) && !empty($_POST['UserName']) && !empty($_POST['ContactNumber']) && !empty($_POST['Email']) && !empty($_POST['Message']) && !empty($_POST['replyMessage'])) {
        $ContactID = $_POST['ContactID'];
        $UserID = $_POST['UserID'];
        $UserName = $_POST['UserName'];
        $UserPhone = $_POST['ContactNumber'];
        $UserEmail = $_POST['Email'];
        $Title = $_POST['Title'];
        $Message = $_POST['Message'];
        $replyMessage = $_POST['replyMessage'];
        $post_time = date('Y-m-d H:i:s');

        $insertReplyQuery = "INSERT INTO email (UserID, UserName, ContactNumber, Email, Title, Message, ReplyMessage, ReplyDate) VALUES ('$UserID', '$UserName', '$UserPhone', '$UserEmail', '$Title','$Message', '$replyMessage','$post_time')";
        $insertReplyResult = $conn->query($insertReplyQuery);

        if ($insertReplyResult) {
            $updateContactQuery = "UPDATE Contact SET ReplyStatus = 'Replied' WHERE ContactID = '$ContactID'";
            $updateContactResult = $conn->query($updateContactQuery);

            if ($updateContactResult) {
                $success = "Reply sent successfully";
                echo "<script>alert('$success'); window.location.href = 'Contact.php';</script>";
                exit;
            } else {
                $error = "Failed to update Contact table";
            }
        } else {
            $error = "Failed to insert into reply table";
        }
    } else {
        $error = "Please fill in all fields";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2>Reply Contact</h2>
        <form method="post">
            <input type="hidden" name="ContactID" value="<?php echo $ContactID ?>">
            <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">User Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="UserName" value="<?php echo $UserName; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">User Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ContactNumber" value="<?php echo $UserPhone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">User Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Email" value="<?php echo $UserEmail; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Message</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Message" value="<?php echo $Message; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Title" placeholder="Your reply title">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Reply</label>
                <div class="col-sm-6">
                    <textarea name="replyMessage" placeholder="Your reply message" class="form-control"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Reply</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="Contact.php" role="button">Cancel</a>
                </div>
            </div>
            <?php
            // 判断是否有错误信息
            if (!empty($error)) {
                // 如果有，显示错误信息
                echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$error</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            ?>
            <?php
            // 判断是否有更新成功信息
            if (!empty($success)) {
                // 如果有，显示更新成功信息
                echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$success</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            ?>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>