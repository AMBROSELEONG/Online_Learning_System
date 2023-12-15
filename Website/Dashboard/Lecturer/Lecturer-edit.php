<?php
//include the connection to the database
include '../../ConnectDB.php';
//declare variables to store the course image, name, price, category id and category name
$LecturerID = "";
$LecturerImage = "";
$LecturerName = "";
$LecturerQualification = "";
$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //check if the lecturer id is set
    if (!isset($_GET['LecturerID'])) {
        //if the lecturer id is not set, redirect to the lecturer page
        header("Location: Lecturer.php");
        exit;
    }

    //store the lecturer id in the id variable
    $id = $_GET['LecturerID'];

    //query the database to get the lecturer details
    $sql = "SELECT * FROM lecturer WHERE LecturerID = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    //check if the lecturer details are not set
    if (!$row) {
        //if the lecturer details are not set, redirect to the lecturer page
        header("Location: Lecturer.php");
        exit;
    }

    //store the lecturer details in the variables
    $LecturerID = $row['LecturerID'];
    $LecturerImage = $row['LecturerImage'];
    $LecturerName = $row['LecturerName'];
    $LecturerQualification = $row['LecturerQualification'];


} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // Use elseif here instead of else
    //store the uploaded file name in the Filename variable
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

    //store the post values in the variables
    $LecturerID = $_POST['LecturerID'];
    $LecturerName = $_POST['LecturerName'];
    $LecturerQualification = $_POST['LecturerQualification'];

    do {
        //check if the post values are empty
        if (empty($LecturerID) || empty($LecturerName) || empty($LecturerQualification) || empty($LecturerImage)) {
            //if the post values are empty, store an error message in the error variable
            $error = "Please fill in all fields";
            break;
        }

        //update the lecturer record in the database
        $sql = "UPDATE lecturer SET LecturerImage = '$LecturerImage', LecturerName = '$LecturerName', LecturerQualification = '$LecturerQualification' WHERE LecturerID = '$LecturerID'";
        $result = $conn->query($sql);
        if (!$result) {
            //if there is an error updating the lecturer record, store the error message in the error variable
            $error = "Error updating lecturer record: " . $conn->error;
            break;
        } else {
            //if the lecturer record has been updated successfully, update the lecturer details in the lecturerdetail table
            $sqlLecturerDetail = "UPDATE lecturerdetail SET LecturerName = '$LecturerName', LecturerQualification = '$LecturerQualification' WHERE LecturerID = '$LecturerID'";
            $resultLecturerDetail = $conn->query($sqlLecturerDetail);

            if (!$resultLecturerDetail) {
                //if there is an error updating the lecturer details, store the error message in the error variable
                $error = "Error updating lecturer detail: " . $conn->error;
                break;
            } else {
                //if the lecturer details have been updated successfully, store a success message in the success variable and redirect to the lecturer page
                $success = "Lecturer updated successfully";
                header("location: Lecturer.php");
                exit;
            }
        }
    } while (false);
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
    <div class="container my-5">
        <h2>Edit Lecturer</h2>

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="LecturerID" value="<?php echo $LecturerID; ?>">
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
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
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
                    <button type="submit" class="btn btn-primary" name="">Submit</button>
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