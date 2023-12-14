<?php
include 'RegisterForm.php';
include '../ConnectDB.php';
// Function to verify the input data
function verify($username, $password, $email, $contactnumber)
{
    $errors = array(); 

    // Check if all fields are filled
    if (empty($username) || empty($password) || empty($email) || empty($contactnumber)) {
        $errors[] = "Please fill in all fields.";
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

    return $errors; 
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the input data from the form
    $username = $_POST['UserName'];
    $password = $_POST['Password'];
    $email = $_POST['Email'];
    $contactnumber = $_POST['ContactNumber'];

    // Call the function to verify the input data
    $errors = verify($username, $password, $email, $contactnumber); // Call the function and store the errors

    // Insert the data into the database
    $insert = "INSERT INTO users(UserName, PasswordHash, Email, ContactNumber) VALUES (?, ?, ?, ?)";
    $stm = $conn->prepare($insert);
    $stm->bind_param("ssss", $username, $password, $email, $contactnumber);

    // Execute the query
    if ($stm->execute()) {
        // Show success message
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
        // Show error message
        echo "Error: " . $stm->error;
    }

    // Close the statement
    $stm->close();
    // Close the connection
    $conn->close();
} else {
    // Show error messages if the request method is not POST
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