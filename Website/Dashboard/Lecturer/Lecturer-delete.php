<?php
// Check if the lecturer ID is set in the GET request
if (isset($_GET['LecturerID'])) {
    // Connect to the database
    include '../../ConnectDB.php';
    // Get the lecturer ID from the GET request
    $id = $_GET['LecturerID'];

    // Delete the lecturer record from the lecturer table
    $sql = "DELETE FROM lecturer WHERE LecturerID = $id";
    // Check if the delete was successful
    if ($conn->query($sql) === TRUE) {
        // Delete the lecturer details record from the lecturer_detail table
        $sql_lecturerdetail = "DELETE FROM lecturerdetail WHERE LecturerID = $id";
        // Redirect the user to the lecturer page
        header('Location: Lecturer.php');
        exit;
    } else {
        // Display an error message if the delete was unsuccessful
        echo "Error deleting record: " . $conn->error;
    }
}
?>