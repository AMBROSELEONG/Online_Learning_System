<?php
//include the connection to the database
include '../../ConnectDB.php';
//declare variables to store the course image, name, price, category id and category name
$LecturerID = "";
$LecturerName = "";
$Professional = "";
$Country = "";
$Github = "";
$Twitter = "";
$Instagram = "";
$Facebook = "";
$LecturerDesription = "";
$LecturerEmail = "";
$Phone = "";
$Introduction = "";
$error = "";
$success = "";

//check if the request method is a GET request
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //check if the course id is set
    if (!isset($_GET['LecturerID'])) {
        //if the course id is not set, redirect to the course page
        header("Location: LecturerDetail.php");
        exit;
    }

    //store the course id in the id variable
    $id = $_GET['LecturerID'];

    //query the database to get the course information
    $sql = "SELECT * FROM lecturerdetail WHERE LecturerID = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    //check if the course information is returned
    if (!$row) {
        //if the course information is not returned, redirect to the course page
        header("Location: LecturerDetail.php");
        exit;
    }

    //store the course information in the corresponding variables
    $LecturerID = $row['LecturerID'];
    $LecturerName = $row['LecturerName'];
    $Professional = $row['Professional'];
    $Country = $row['Country'];
    $Github = $row['Github'];
    $Twitter = $row['Twitter'];
    $Instagram = $row['Instagram'];
    $Facebook = $row['Facebook'];
    $LecturerDesription = $row['LecturerDescription'];
    $LecturerEmail = $row['LecturerEmail'];
    $Phone = $row['Phone'];
    $Introduction = $row['Introduction'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // Use elseif here instead of else
    //store the course information in the corresponding variables
    $LecturerID = isset($_POST['LecturerID']) ? $_POST['LecturerID'] : '';
    $LecturerName = isset($_POST['LecturerName']) ? $_POST['LecturerName'] : '';
    // Rest of your code remains the same
    $LecturerID = $_POST['LecturerID'];
    $Professional = $_POST['Professional'];
    $Country = $_POST['Country'];
    $Github = $_POST['Github'];
    $Twitter = $_POST['Twitter'];
    $Instagram = $_POST['Instagram'];
    $Facebook = $_POST['Facebook'];
    $LecturerDesription = $_POST['LecturerDesription'];
    $LecturerEmail = $_POST['LecturerEmail'];
    $Phone = $_POST['Phone'];
    $Introduction = $_POST['Introduction'];
    do {
        //check if any of the course information is empty
        if (empty($LecturerID) || empty($Professional) || empty($Country) || empty($Github) || empty($Twitter) || empty($Instagram) || empty($Facebook) || empty($LecturerDesription) || empty($LecturerEmail) || empty($Phone) || empty($Introduction)) {
            //if any of the course information is empty, store an error message in the error variable
            $error = "Please fill in all fields";
            break;
        }
        //update the course information in the database
        $sql = "UPDATE lecturerdetail SET Professional = ?, Country = ?, Github = ?, Twitter = ?, Instagram = ?, Facebook = ?, LecturerDescription = ?, LecturerEmail = ?, Phone = ?, Introduction = ? WHERE LecturerID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssi", $Professional, $Country, $Github, $Twitter, $Instagram, $Facebook, $LecturerDesription, $LecturerEmail, $Phone, $Introduction, $LecturerID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $success = "Course Details updated successfully";
            header("location: LecturerDetail.php");
            exit;
        } else {
            $error = "Error updating course detail: " . $conn->error;

        }
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2>Edit Course Detail</h2>
        <form method="post">
            <input type="hidden" name="LecturerID" value="<?php echo $LecturerID; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Lecturer Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="LecturerName" value="<?php echo $LecturerName; ?>"
                        disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Professional</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Professional" value="<?php echo $Professional; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Country</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Country" value="<?php echo $Country; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">GitHub</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Github" value="<?php echo $Github; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Twitter</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Twitter" value="<?php echo $Twitter; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Instagram</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Instagram" value="<?php echo $Instagram; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Facebook</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Facebook" value="<?php echo $Facebook; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Lecturer Description</label>
                <div class="col-sm-6">
                    <textarea class="form-control"
                        name="LecturerDesription"><?php echo $LecturerDesription; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="LecturerEmail" value="<?php echo $LecturerEmail; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Phone" value="<?php echo $Phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Introduction</label>
                <div class="col-sm-6">
                    <textarea type="text" class="form-control"
                        name="Introduction"><?php echo $Introduction; ?></textarea>
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
                    <button type="submit" class="btn btn-primary" name="EditLecturer">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="LecturerDetail.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>