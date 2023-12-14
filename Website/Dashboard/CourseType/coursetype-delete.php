<?php
// Check if the CategoryID is set in the GET request
if (isset($_GET['CategoryID'])) {
    // Connect to the database
    include '../../ConnectDB.php';
    // Get the CategoryID from the GET request
    $id = $_GET['CategoryID'];

    // Create an SQL query to delete the record from the coursecategory table where the CategoryID matches the one from the GET request
    $sql = "DELETE FROM coursecategory WHERE CategoryID = $id";
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect the user to the CourseType.php page
        header('Location: CourseType.php');
        exit;
    } else {
        // If an error occurs, display an error message
        echo "Error deleting record: " . $conn->error;
    }
}
?>