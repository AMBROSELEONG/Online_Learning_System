<?php
if (isset($_GET['CommentID'])) {
    include '../../ConnectDB.php';
    $id = $_GET['CommentID'];

    $sql = "DELETE FROM comments WHERE CommentID = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: Comment.php');
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>