<?php
// 引入注册表单页面
include 'RegisterForm.php';
// 连接数据库
include '../ConnectDB.php';
// 验证用户输入的信息
function verify($username, $password, $email, $contactnumber)
{
    $errors = array(); 

    // 检查用户输入的信息是否为空
    if (empty($username) || empty($password) || empty($email) || empty($contactnumber)) {
        $errors[] = "Please fill in all fields.";
    }


    // 检查两次输入的密码是否一致
    if ($password !== $_POST["repeatpassword"]) {
        $errors[] = "Password and Repeat Password do not match.";
    }

    // 检查输入的邮箱是否有效
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // 检查输入的电话号码是否有效
    if (!preg_match("/^(01[0-9])?\d{7,8}$/", $contactnumber)) {
        $errors[] = "Please enter a valid 10-digit phone number.";
    }

    return $errors; 
}

// 判断请求方式
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 获取用户输入的信息
    $username = $_POST['UserName'];
    $password = $_POST['Password'];
    $email = $_POST['Email'];
    $contactnumber = $_POST['ContactNumber'];

    // 验证用户输入的信息
    $errors = verify($username, $password, $email, $contactnumber); // Call the function and store the errors

    // 向数据库中插入用户信息
    $insert = "INSERT INTO users(UserName, PasswordHash, Email, ContactNumber) VALUES (?, ?, ?, ?)";
    $stm = $conn->prepare($insert);
    $stm->bind_param("ssss", $username, $password, $email, $contactnumber);

    // 执行插入操作
    if ($stm->execute()) {
        // 注册成功，弹出提示框，并跳转到登录页面
        echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Registration successful!',
                    icon: 'success'
                }).then(() => {
                    window.location.href = '../Login/Login.php'; // Redirect to login page after 'OK' is clicked
                });
            </script>";
    } else {
        // 注册失败，弹出错误信息
        echo "Error: " . $stm->error;
    }

    // 关闭数据库连接
    $stm->close();
    $conn->close();
} else {
    // 检查输入的信息是否有效
    foreach ($errors as $error) {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: '$error',
                    icon: 'error'
                });
            </script>";
    }
}
?>