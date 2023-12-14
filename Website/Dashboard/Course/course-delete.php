<?php
// Check if the CourseID is set in the GET request
if (isset($_GET['CourseID'])) {
    // Connect to the database
    include '../../ConnectDB.php';
    // Get the CourseID from the GET request
    $id = $_GET['CourseID'];

    // Create a SQL statement to delete the record from the course table
    $sql = "DELETE FROM course WHERE CourseID = $id";
    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        // Redirect the user to the Course.php page
        header('Location: Course.php');
        exit;
    } else {
        // Display an error message if the record could not be deleted
        echo "Error deleting record: " . $conn->error;
    }
}
?>