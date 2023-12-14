<?php
if (isset($_GET['LecturerID'])) {
    include '../../ConnectDB.php';
    $id = $_GET['LecturerID'];

    $sql = "DELETE FROM lecturer WHERE LecturerID = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: Lecturer.php');
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>