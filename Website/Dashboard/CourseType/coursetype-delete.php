<?php
if (isset($_GET['CategoryID'])) {
    include '../../ConnectDB.php';
    $id = $_GET['CategoryID'];

    $sql = "DELETE FROM coursecategory WHERE CategoryID = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: CourseType.php');
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>