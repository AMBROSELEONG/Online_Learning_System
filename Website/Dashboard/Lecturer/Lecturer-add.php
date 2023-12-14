<?php
include '../../ConnectDB.php';
$LecturerName = "";
$LecturerQualification = "";
$CourseID = "";
$CourseName = "";
$error = "";
$success = "";

if (isset($_POST['AddLecturer'])) {
    $LecturerName = $_POST['LecturerName'];
    $LecturerQualification = $_POST['LecturerQualification'];
    $CourseID = $_POST['CourseID'];
    $CourseName = $_POST['CourseName'];

    $query = "INSERT INTO lecturer(LecturerName, LecturerQualification, CourseID, CourseName) VALUES ('$LecturerName', '$LecturerQualification',$CourseID,'$CourseName')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        $success = "Lecturer Added Successfully";
        header("location: Lecturer.php");
    }else{
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

        <form method="post" action="">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Lecturer Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="LecturerName" value="<?php echo $LecturerName; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Lecturer Qualification</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="LecturerQualification" value="<?php echo $LecturerQualification; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Name</label>
                <div class="col-sm-6">
                    <select type="text" class="form-control" name="CourseID" id="CourseID">
                        <?php
                            $query1 = "SELECT CourseID, CourseName FROM course";
                            $result1 = mysqli_query($conn, $query1);

                            if ($result1) {
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    $Course_ID = $row['CourseID'];
                                    $Course_Name = $row['CourseName'];
                                    echo "<option class='form-control' value='$Course_ID'>$Course_Name</option>";
                                }
                            } else {
                                echo "<option class='form-control' value='0'>No Course Found</option>";
                            }
                            ?>
                    </select>
                    <input type="hidden" name="CourseName" id="CourseName" value="<?php echo $Course_Name ?>">
                </div>
            </div>

            <script>
                document.getElementById('CourseID').addEventListener('change', function () {
                    var selectedIndex = this.selectedIndex;
                    var selectedOption = this.options[selectedIndex];
                    var courseName = selectedOption.text;

                    document.getElementById('CourseName').value = courseName;
                });
            </script>

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