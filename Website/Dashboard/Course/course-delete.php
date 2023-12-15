<?php
// Check if the CourseID is set in the GET request
if (isset($_GET['CourseID'])) {
    // Connect to the database
    include '../../ConnectDB.php';
    // Get the CourseID from the GET request
    $id = $_GET['CourseID'];

    // Create a SQL statement to delete records from coursedetail table
    $sql_detail = "DELETE FROM coursedetail WHERE CourseID = $id";

    // Execute the SQL statement to delete records from coursedetail table
    if ($conn->query($sql_detail) === TRUE) {
        // Delete associated lecturer records
        $sql_lecturer = "DELETE FROM lecturer WHERE CourseID = $id";
        if ($conn->query($sql_lecturer) === TRUE) {
            // If lecturer records are deleted, proceed to delete from course table
            $sql_course = "DELETE FROM course WHERE CourseID = $id";

            // Execute the SQL statement to delete records from course table
            if ($conn->query($sql_course) === TRUE) {
                // Redirect the user to the Course.php page
                header('Location: Course.php');
                exit;
            } else {
                // Display an error message if the records could not be deleted from the course table
                echo "Error deleting record from course table: " . $conn->error;
            }
        } else {
            // Display an error message if the records could not be deleted from the lecturer table
            echo "Error deleting records from lecturer table: " . $conn->error;
        }
    } else {
        // Display an error message if the records could not be deleted from the coursedetail table
        echo "Error deleting record from coursedetail table: " . $conn->error;
    }
}

?>