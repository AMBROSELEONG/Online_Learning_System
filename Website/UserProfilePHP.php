<?php
include 'ConnectDB.php';

if (isset($_POST['save'])) {
    $username = $_POST['Username'];
    $collegename = $_POST['CollegeName'];
    $gmail = $_POST['Gmail'];
    $phone = $_POST['Phone'];
    $about = $_POST['About'];

    if ($username == "" || $collegename == "" || $gmail == "" || $phone == "" || $about == "") {
        echo "<script>alert('Please fill all the fields!')</script>";
    } else {
        $sql = "INSERT INTO userprofile (UserName, CollegeName, Gmail, Phone, About) VALUES ('$username', '$collegename', '$gmail', '$phone', '$about')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Record added successfully!')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>