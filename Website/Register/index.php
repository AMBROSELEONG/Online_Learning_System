<?php
include '../ConnectDB.php';
session_start();

// Check if password is valid
function validatePassword($password)
{
    $errors = [];
    if (strlen($password) < 8) {
        $errors[] = "Password length must be at least 8 characters.";
    }

    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password should contain at least one lowercase letter.";
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password should contain at least one uppercase letter.";
    }

    if (!preg_match('/\d/', $password)) {
        $errors[] = "Password should contain at least one number.";
    }

    if (!preg_match('/[^a-zA-Z\d]/', $password)) {
        $errors[] = "Password should contain at least one special character.";
    }
    return $errors;
}
// Function to verify the input data
function verify($username, $password, $email, $contactnumber)
{
    $errors = []; // Initialize an empty array for errors

    // Check if all fields are filled
    if (empty($username) || empty($password) || empty($email) || empty($contactnumber)) {
        $errors[] = "Please fill in all fields.";
    }

    // Check if username is valid
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $errors[] = "Username can only contain letters and numbers.";
    }

    // Check if password and repeat password match
    if ($password !== $_POST["repeatpassword"]) {
        $errors[] = "Password and Repeat Password do not match.";
    }

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // Check if contact number is valid
    if (!preg_match("/^(01[0-9])?\d{7,8}$/", $contactnumber)) {
        $errors[] = "Please enter a valid 10-digit phone number.";
    }

    return $errors; // Return the array of errors
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['UserName'];
    $password = $_POST['Password'];
    $email = $_POST['Email'];
    $contactnumber = $_POST['ContactNumber'];

    $passwordErrors = validatePassword($password);
    $inputErrors = verify($username, $password, $email, $contactnumber);
    $errors = array_merge($passwordErrors, $inputErrors);

    if (empty($errors)) {
        // Check if the username already exists
        $checkExistingUser = "SELECT UserName FROM users WHERE UserName = ?";
        $checkStmt = $conn->prepare($checkExistingUser);
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $errors[] = "Username already exists. Please choose a different username.";
            $_SESSION['errors'] = $errors;
            header('Location: RegisterForm.php');
            exit();
        }

        $checkStmt->close();

        // Proceed with inserting the user since the username is unique
        $insert = "INSERT INTO users(UserName, PasswordHash, Email, ContactNumber) VALUES (?, ?, ?, ?)";
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $stm = $conn->prepare($insert);
        $stm->bind_param("ssss", $username, $hashedPassword, $email, $contactnumber);

        if ($stm->execute()) {
            echo "<script>alert('Register Successful!'); window.location.href = '../Login/Login.php'</script>";
            exit();
        }

        $stm->close();
    } else {
        $_SESSION['errors'] = $errors;
        header('Location: RegisterForm.php');
        exit();
    }

    $conn->close();
} else {
    $_SESSION['error_message'] = "Invalid request method.";
    header('Location: RegisterForm.php');
    exit();
}
?>