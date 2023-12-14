<?php
// Check if the CategoryID is set in the GET request
if (isset($_GET['CategoryID'])) {
    // Connect to the database
    include '../../ConnectDB.php';
    // Get the value of the CategoryID from the GET request
    $id = $_GET['CategoryID'];

    // Create a SQL statement to delete the record from the quizcategory table where the CategoryID matches the one from the GET request
    $sql = "DELETE FROM quizcategory WHERE CategoryID = $id";
    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        // Redirect the user to the QuizType.php page
        header('Location: QuizType.php');
        exit;
    } else {
        // If an error occurs, display an error message
        echo "Error deleting record: " . $conn->error;
    }
}
?>