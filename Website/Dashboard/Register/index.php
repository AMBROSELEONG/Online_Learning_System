<?php
include '../../ConnectDB.php';
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
function verify($username, $password, $email, $contactnumber, $IC, $occupation, $verifycode)
{
    $errors = []; // Initialize an empty array for errors

    // Check if all fields are filled
    if (empty($username) || empty($password) || empty($email) || empty($contactnumber) || empty($IC) || empty($occupation) || empty($verifycode)) {
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

    if (!preg_match("/^\d{2}(0[1-9]|1[0-2])(0[1-9]|1\d|2\d|3[0-1])\d{2}\d{4}$/",$IC)) {
        $errors[] = "Please enter a valid 12-digit Malaysian IC number without hyphens.";
    }

    return $errors; // Return the array of errors
}

function verifyOccupationAndCode($occupation, $verifycode)
{
    $errors = [];
    // Array of valid codes for each occupation
    $validCodes = [
        'Admin' => 'admincode@111',
        'ContentManager' => 'contentcode@222',
        'DataAdministrator' => 'dataadmincode@333',
        'CustomerSupport' => 'customercode@444',
        'SecurityAdministrator' => 'securitycode@555',
        'FinancialAdministrator' => 'financialcode@666',
        'ProjectManager' => 'projectcode@777',
    ];

    // Check if the occupation is valid
    if (array_key_exists($occupation, $validCodes)) {
        $expectedCode = $validCodes[$occupation];
        if ($verifycode !== $expectedCode) {
            $errors[] = "Verification code is incorrect for the selected occupation.";
        }
    } else {
        $errors[] = "Please select a valid occupation.";
    }

    return $errors;
}

function isUsernameUnique($conn, $username) {
    // Check if the username already exists in the database
    $checkUsernameQuery = "SELECT UserName FROM admin WHERE UserName = ?";
    $stmt = $conn->prepare($checkUsernameQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // If the username exists, return false; else, return true
    return $stmt->num_rows === 0;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the input data from the form
    $username = $_POST['UserName'];
    $password = $_POST['Password'];
    $email = $_POST['Email'];
    $contactnumber = $_POST['ContactNumber'];
    $IC = $_POST['IC'];
    $occupation = $_POST['Occupation'];
    $verifycode = $_POST['verificationCode'];

    $passwordErrors = validatePassword($password);
    $verifyerror = verifyOccupationAndCode($occupation, $verifycode);
    $inputErrors = verify($username, $password, $email, $contactnumber, $IC, $occupation, $verifycode);
    $errors = array_merge($passwordErrors, $inputErrors, $verifyerror);

    if (empty($errors) && isUsernameUnique($conn, $username)) {
        // Insert data into the database
        $insert = "INSERT INTO admin(UserName, Password, Email, ContactNumber, IC, Occupation) VALUES (?, ?, ?, ?, ?, ?)";
        $stm = $conn->prepare($insert);
        $stm->bind_param("ssssss", $username, $password, $email, $contactnumber, $IC, $occupation);

        // Execute the query
        if ($stm->execute()) {
           echo "<script>alert('Register Successful!'); window.location.href = '../Login/Login.php'</script>";
            exit();
        }

        // Close the statement
        $stm->close();
    } else {
        // If username is not unique, add an error message
        $errors[] = "Username is already taken. Please choose a different username.";
        $_SESSION['errors'] = $errors;
        header('Location: Register.php');
        exit();
    }

    // Close the connection
    $conn->close();
} else {
    $_SESSION['error_message'] = "Invalid request method."; // Store error in session for invalid request method
     header('Location: Register.php');
    exit();
}
?>