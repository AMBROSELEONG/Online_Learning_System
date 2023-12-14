<?php
// Check if the UserID is set in the GET request
if (isset($_GET['UserID'])) {
    // Connect to the database
    include '../../ConnectDB.php';
    // Get the UserID from the GET request
    $id = $_GET['UserID'];

    // Create a SQL query to delete the record from the users table
    $sql = "DELETE FROM users WHERE UserID = $id";
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect the user to the User.php page
        header('Location: User.php');
        exit;
    } else {
        // Print an error message if the query fails
        echo "Error deleting record: " . $conn->error;
    }
}
?>