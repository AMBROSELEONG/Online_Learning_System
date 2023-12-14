<?php
// Check if the CommentID is set in the GET request
if (isset($_GET['CommentID'])) {
    // Connect to the database
    include '../../ConnectDB.php';
    // Get the CommentID from the GET request
    $id = $_GET['CommentID'];

    // Create a SQL statement to delete the record from the comments table
    $sql = "DELETE FROM comments WHERE CommentID = $id";
    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        // Redirect the user to the Comment.php page
        header('Location: Comment.php');
        exit;
    } else {
        // Display an error message if the record could not be deleted
        echo "Error deleting record: " . $conn->error;
    }
}
?>