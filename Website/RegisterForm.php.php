<?php
    include '../../Website/RegisterForm/RegisterForm.php';
?>

<?php
function verify($username, $password, $email, $contactnumber)
{
    $errors = array(); // Create an array to store validation error messages

    if (empty($username) || empty($password) || empty($email) || empty($contactnumber)) {
        $errors[] = "Please fill in all fields.";
    }

    // Validate form data
    if ($password !== $_POST["repeatpassword"]) {
        $errors[] = "Password and Repeat Password do not match.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (!preg_match("/^(01[0-9])?\d{7,8}$/", $contactnumber)) {
        $errors[] = "Please enter a valid 10-digit phone number.";
    }

    return $errors; // Return the array of errors
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['UserName'];
    $password = $_POST['Password'];
    $email = $_POST['Email'];
    $contactnumber = $_POST['ContactNumber'];

    $errors = verify($username, $password, $email, $contactnumber); // Call the function and store the errors

    if (empty($errors)) {
        $servername = "localhost";
        $user = "root";
        $pass = "0000";
        $dbName = "online_learning_system";

        $conn = new mysqli($servername, $user, $pass, $dbName);

        if ($conn->connect_error) {
            die("Connection Failed: " . $conn->connect_error);
        }

        $insert = "INSERT INTO User(UserName, PasswordHash, Email, ContactNumber) VALUES (?, ?, ?, ?)";
        $stm = $conn->prepare($insert);
        $stm->bind_param("sssi", $username, $password, $email, $contactnumber);
        
        if ($stm->execute()) {
            echo "<script>
                swal({
                    title: 'Success!',
                    text: 'Registration successful!',
                    icon: 'success'
                });
            </script>";
        } else {
            echo "Error: " . $stm->error;
        }
        
        $stm->close();
        $conn->close();
    } else {
        // Handle errors (display or log them)
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        header("location: ");
    }
}
?>