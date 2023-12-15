<?php
include '../../ConnectDB.php';

// Initialize variables
$LecturerImage = "";
$LecturerName = "";
$LecturerQualification = "";

$error = "";
$success = "";

// Check if the AddLecturer button has been clicked
if (isset($_POST['AddLecturer'])) {

    // Get the file name from the uploaded file
    $Filename = $_FILES['LecturerImage']['name'];
    //check if the file has been uploaded successfully
    if (
        move_uploaded_file(
            $_FILES['LecturerImage']['tmp_name'],
            "lecturer-image/" . $Filename)
    ) {
        //if the file has been uploaded successfully, store the file path in the course image variable
        $LecturerImage = "lecturer-image/" . $Filename;
    } else {
        //if the file has not been uploaded successfully, store an error message in the error variable
        $error = "File could not be uploaded";
    }

    // Get the lecturer name, qualification and file name from the form
    $LecturerName = $_POST['LecturerName'];
    $LecturerQualification = $_POST['LecturerQualification'];

    // Insert the lecturer details into the lecturer table
    $query = "INSERT INTO lecturer(LecturerImage ,LecturerName, LecturerQualification) VALUES ('$LecturerImage','$LecturerName', '$LecturerQualification')";
    $result = mysqli_query($conn, $query);

    if ($result) {

        // Get the new lecturer ID
        $newLecturerID = mysqli_insert_id($conn);

        // Now you can proceed to add the details into the lecturerdetail table
        $queryLecturerDetail = "INSERT INTO lecturerdetail(LecturerID, LecturerName, LecturerQualification) VALUES ('$newLecturerID', '$LecturerName','$LecturerQualification')";

        $resultLecturerDetail = mysqli_query($conn, $queryLecturerDetail);

        if ($resultLecturerDetail) {
            // Successfully added details into lecturerdetail
            header("location: Lecturer.php");
        } else {
            // Error adding details into lecturerdetail
            $error = "Error adding details into lecturerdetail: " . $conn->error;
        }
    } else {
        // Error adding lecturer details into the lecturer table
        $error = "Lecturer Added Error" . $conn->error;
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container ny-5">
        <h2>New Lecturer</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Lecturer Image</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="LecturerImage" value="<?php echo $LecturerImage; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Lecturer Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="LecturerName" value="<?php echo $LecturerName; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Lecturer Qualification</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="LecturerQualification"
                        value="<?php echo $LecturerQualification; ?>">
                </div>
            </div>
            <?php
            if (!empty($success)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$success</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            if (!empty($error)) {
                echo "
                    <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$error</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="AddLecturer">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="Lecturer.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>