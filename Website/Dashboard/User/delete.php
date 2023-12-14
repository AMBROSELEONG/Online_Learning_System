<?php
if (isset($_GET['UserID'])) {
    include '../../ConnectDB.php';
    $id = $_GET['UserID'];

    $sql = "DELETE FROM users WHERE UserID = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: User.php');
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>