<?php
if (isset($_GET['CourseID'])) {
    include '../../ConnectDB.php';
    $id = $_GET['CourseID'];

    $sql = "DELETE FROM course WHERE CourseID = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: Course.php');
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>