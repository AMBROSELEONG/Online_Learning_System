<?php
// Check if the lecturer ID is set in the GET request
if (isset($_GET['LecturerID'])) {
    // Connect to the database
    include '../../ConnectDB.php';
    // Get the lecturer ID from the GET request
    $id = $_GET['LecturerID'];


    $sql_coursedetail = "DELETE FROM coursedetail WHERE LecturerID = ?";
    $stmt_coursedetail = $conn->prepare($sql_coursedetail);
    $stmt_coursedetail->bind_param("i", $id); // Assuming LecturerID is an integer

    if ($stmt_coursedetail->execute()) {

        // Prepare and bind the DELETE statement
        $sql = "DELETE FROM lecturerdetail WHERE LecturerID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id); // Assuming LecturerID is an integer

        // Execute the delete statement for lecturerdetail table
        if ($stmt->execute()) {
            // Prepare and bind the DELETE statement for lecturer table
            $sql_lecturerdetail = "DELETE FROM lecturer WHERE LecturerID = ?";
            $stmt_lecturerdetail = $conn->prepare($sql_lecturerdetail);
            $stmt_lecturerdetail->bind_param("i", $id); // Assuming LecturerID is an integer

            // Execute the delete statement for lecturer table
            if ($stmt_lecturerdetail->execute()) {
                // Redirect the user to the lecturer page if successful
                header('Location: Lecturer.php');
                exit;
            } else {
                // Display an error message if the delete was unsuccessful
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            // Display an error message if the delete was unsuccessful
            echo "Error deleting record: " . $conn->error;
        }
    }
}
?>